<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Interfaces\ImageInterface;

class ImageProcessingService
{
    protected ImageManager $manager;
    
    protected array $sizes = [
        'thumb' => 320,
        'small' => 640, 
        'large' => 1024,
    ];

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }
    
    protected function getDisk(): string
    {
        return config('app.env') === 'production' 
            ? (config('filesystems.user_items_disk', 'user_items_s3'))
            : 'user_items';
    }

    public function processImage(UploadedFile $file, int $itemId): array
    {
        // Generate MD5 hash for the image
        $hash = md5_file($file->getRealPath());
        
        // Create directory path
        $directory = "useritems/{$itemId}";
        
        // Process each size
        $imageData = [];
        
        foreach ($this->sizes as $sizeName => $dimension) {
            $filename = "{$hash}-{$sizeName}.webp";
            $path = "{$directory}/{$filename}";
            
            // Process and resize image
            $processedImage = $this->resizeAndConvertToWebP($file, $dimension);
            
            // Store the image
            Storage::disk($this->getDisk())->put($path, $processedImage);
            
            // Generate URL
            $url = Storage::disk($this->getDisk())->url($path);
            
            $imageData[$sizeName] = $url;
        }
        
        return [$hash => $imageData];
    }

    public function processMultipleImages(array $files, int $itemId): array
    {
        $allImageData = [];
        
        foreach ($files as $file) {
            $imageData = $this->processImage($file, $itemId);
            $allImageData = array_merge($allImageData, $imageData);
        }
        
        return $allImageData;
    }

    protected function resizeAndConvertToWebP(UploadedFile $file, int $maxDimension): string
    {
        $image = $this->manager->read($file->getRealPath());
        
        // Resize maintaining aspect ratio
        $image = $this->resizeImage($image, $maxDimension);
        
        // Convert to WebP and return as string
        return $image->toWebp(quality: 85)->toString();
    }

    protected function resizeImage(ImageInterface $image, int $maxDimension): ImageInterface
    {
        $width = $image->width();
        $height = $image->height();
        
        // Calculate new dimensions maintaining aspect ratio
        if ($width > $height) {
            // Landscape orientation
            if ($width > $maxDimension) {
                $newWidth = $maxDimension;
                $newHeight = (int) ($height * ($maxDimension / $width));
                $image = $image->resize($newWidth, $newHeight);
            }
        } else {
            // Portrait or square orientation
            if ($height > $maxDimension) {
                $newHeight = $maxDimension;
                $newWidth = (int) ($width * ($maxDimension / $height));
                $image = $image->resize($newWidth, $newHeight);
            }
        }
        
        return $image;
    }

    public function deleteImages(array $imageData, int $itemId): void
    {
        $directory = "useritems/{$itemId}";
        
        foreach ($imageData as $hash => $sizes) {
            foreach ($this->sizes as $sizeName => $dimension) {
                $filename = "{$hash}-{$sizeName}.webp";
                $path = "{$directory}/{$filename}";
                
                if (Storage::disk($this->getDisk())->exists($path)) {
                    Storage::disk($this->getDisk())->delete($path);
                }
            }
        }
    }
    
    public function deleteImage(string $hash, int $itemId): void
    {
        $directory = "useritems/{$itemId}";
        
        foreach ($this->sizes as $sizeName => $dimension) {
            $filename = "{$hash}-{$sizeName}.webp";
            $path = "{$directory}/{$filename}";
            
            if (Storage::disk($this->getDisk())->exists($path)) {
                Storage::disk($this->getDisk())->delete($path);
            }
        }
    }

    public function getImageUrl(string $hash, string $size, int $itemId): ?string
    {
        if (!in_array($size, array_keys($this->sizes))) {
            return null;
        }
        
        $filename = "{$hash}-{$size}.webp";
        $path = "useritems/{$itemId}/{$filename}";
        
        if (Storage::disk($this->getDisk())->exists($path)) {
            return Storage::disk($this->getDisk())->url($path);
        }
        
        return null;
    }
}