<?php

namespace App\Filament\Resources\Items\Pages;

use App\Filament\Resources\Items\ItemResource;
use App\Services\ImageProcessingService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class EditItem extends EditRecord
{
    protected static string $resource = ItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('test_image_processing')
                ->label('Test Image Processing')
                ->color('warning')
                ->action(function () {
                    $imageProcessingService = app(ImageProcessingService::class);
                    
                    // Create a test image for processing
                    $testImagePath = storage_path('app/test-image.jpg');
                    if (!file_exists($testImagePath)) {
                        // Create a simple test image
                        $image = imagecreate(800, 600);
                        $white = imagecolorallocate($image, 255, 255, 255);
                        $black = imagecolorallocate($image, 0, 0, 0);
                        imagefill($image, 0, 0, $white);
                        imagestring($image, 5, 100, 100, 'Test Image', $black);
                        imagejpeg($image, $testImagePath);
                        imagedestroy($image);
                    }
                    
                    try {
                        $uploadedFile = new \Illuminate\Http\UploadedFile(
                            $testImagePath,
                            'test-image.jpg',
                            'image/jpeg',
                            null,
                            true
                        );
                        
                        $result = $imageProcessingService->processImage($uploadedFile, $this->record->id);
                        
                        $existingImages = $this->record->images ?? [];
                        $allImages = array_merge($existingImages, $result);
                        
                        $this->record->update(['images' => $allImages]);
                        
                        Notification::make()
                            ->title('Test image processed successfully!')
                            ->body('Hash: ' . array_key_first($result))
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Error processing image')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $this->processUploadedImages();
    }

    protected function processUploadedImages(): void
    {
        $tempImages = data_get($this->data, 'temp_images', []);
        
        logger()->info('Processing uploaded images', ['temp_images' => $tempImages, 'record_id' => $this->record->id]);
        
        if (empty($tempImages) || !$this->record) {
            logger()->info('No temp images or no record');
            return;
        }

        $imageProcessingService = app(ImageProcessingService::class);
        $processedImages = [];

        foreach ($tempImages as $filePath) {
            if (is_string($filePath)) {
                $fullPath = storage_path('app/private/' . $filePath);
                logger()->info('Processing file', ['path' => $fullPath, 'exists' => file_exists($fullPath)]);
                
                if (file_exists($fullPath)) {
                    $uploadedFile = new UploadedFile(
                        $fullPath,
                        basename($filePath),
                        mime_content_type($fullPath),
                        null,
                        true
                    );

                    try {
                        $imageData = $imageProcessingService->processImage($uploadedFile, $this->record->id);
                        $processedImages = array_merge($processedImages, $imageData);
                        logger()->info('Image processed successfully', ['result' => $imageData]);
                        
                        // Clean up temp file
                        unlink($fullPath);
                    } catch (\Exception $e) {
                        logger()->error('Image processing failed: ' . $e->getMessage());
                    }
                }
            }
        }

        if (!empty($processedImages)) {
            $existingImages = $this->record->images ?? [];
            $allImages = array_merge($existingImages, $processedImages);
            
            logger()->info('Updating record with images', ['images' => $allImages]);
            $this->record->update(['images' => $allImages]);
            
            // Clear the temp_images field
            $this->data['temp_images'] = [];
            
            Notification::make()
                ->title('Images processed successfully!')
                ->body(count($processedImages) . ' image(s) converted to WebP format')
                ->success()
                ->send();
        }
    }

    public function updateImageOrder(Request $request)
    {
        $newOrder = $request->input('order', []);
        $currentImages = $this->record->images ?? [];
        
        if (empty($newOrder) || empty($currentImages)) {
            return response()->json(['success' => false, 'message' => 'Invalid data']);
        }
        
        // Reorder the images based on the new order
        $reorderedImages = [];
        foreach ($newOrder as $hash) {
            if (isset($currentImages[$hash])) {
                $reorderedImages[$hash] = $currentImages[$hash];
            }
        }
        
        // Add any images that weren't in the new order (safety measure)
        foreach ($currentImages as $hash => $data) {
            if (!isset($reorderedImages[$hash])) {
                $reorderedImages[$hash] = $data;
            }
        }
        
        $this->record->update(['images' => $reorderedImages]);
        
        return response()->json(['success' => true, 'message' => 'Image order updated successfully']);
    }
    
    public function deleteImage(Request $request)
    {
        $hashToDelete = $request->input('hash');
        $currentImages = $this->record->images ?? [];
        
        if (!$hashToDelete || !isset($currentImages[$hashToDelete])) {
            return response()->json(['success' => false, 'message' => 'Image not found']);
        }
        
        // Delete files from storage
        $imageProcessingService = app(ImageProcessingService::class);
        $imageProcessingService->deleteImage($hashToDelete, $this->record->id);
        
        // Remove from database
        unset($currentImages[$hashToDelete]);
        $this->record->update(['images' => $currentImages]);
        
        return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
    }
}