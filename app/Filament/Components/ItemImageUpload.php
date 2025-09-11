<?php

namespace App\Filament\Components;

use App\Services\ImageProcessingService;
use Filament\Forms\Components\BaseFileUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class ItemImageUpload extends BaseFileUpload
{
    protected string $view = 'filament.components.item-image-upload';
    
    protected ImageProcessingService $imageProcessingService;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->imageProcessingService = app(ImageProcessingService::class);
    }

    public static function make(string $name): static
    {
        return app(static::class, ['name' => $name]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->acceptedFileTypes(['image/*'])
            ->multiple()
            ->saveUploadedFileUsing(function (UploadedFile $file, $component) {
                return $this->processAndStoreImage($file, $component);
            })
            ->getUploadedFileNameForStorageUsing(fn (UploadedFile $file): string => $file->hashName())
            ->downloadable(false)
            ->openable(false)
            ->deletable(true)
            ->reorderable(true);
    }

    protected function processAndStoreImage(UploadedFile $file, $component): ?string
    {
        // Get the item ID from the form state
        $record = $component->getRecord();
        $itemId = $record ? $record->id : null;

        if (!$itemId) {
            // For new records, we'll use a temporary ID or handle after save
            return null;
        }

        try {
            $imageData = $this->imageProcessingService->processImage($file, $itemId);
            
            // Return the hash as the stored value
            return array_key_first($imageData);
        } catch (\Exception $e) {
            // Log error and return null
            logger()->error('Image processing failed: ' . $e->getMessage());
            return null;
        }
    }

    public function getUploadedFileUrls(): array
    {
        $state = $this->getState();
        
        if (!$state || !is_array($state)) {
            return [];
        }

        $record = $this->getRecord();
        $itemId = $record ? $record->id : null;
        
        if (!$itemId) {
            return [];
        }

        $urls = [];
        
        foreach ($state as $hash) {
            if (is_string($hash)) {
                $thumbUrl = $this->imageProcessingService->getImageUrl($hash, 'thumb', $itemId);
                if ($thumbUrl) {
                    $urls[$hash] = $thumbUrl;
                }
            }
        }

        return $urls;
    }

    protected function mutateDehydratedStateUsing($state, $component): mixed
    {
        if (!$state || !is_array($state)) {
            return [];
        }

        $record = $component->getRecord();
        $itemId = $record ? $record->id : null;
        
        if (!$itemId) {
            return [];
        }

        // Convert array of hashes to the required JSON structure
        $imageData = [];
        
        foreach ($state as $hash) {
            if (is_string($hash)) {
                $sizes = [];
                foreach (['thumb', 'small', 'large'] as $size) {
                    $url = $this->imageProcessingService->getImageUrl($hash, $size, $itemId);
                    if ($url) {
                        $sizes[$size] = $url;
                    }
                }
                
                if (!empty($sizes)) {
                    $imageData[$hash] = $sizes;
                }
            }
        }

        return $imageData;
    }

    protected function hydrateStateUsing($state): mixed
    {
        // Convert from JSON structure to array of hashes for the component
        if (!$state || !is_array($state)) {
            return [];
        }

        return array_keys($state);
    }
}