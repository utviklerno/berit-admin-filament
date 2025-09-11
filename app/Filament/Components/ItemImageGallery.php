<?php

namespace App\Filament\Components;

use App\Services\ImageProcessingService;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Concerns\HasState;
use Illuminate\View\Component as BladeComponent;

class ItemImageGallery extends Component
{
    protected string $view = 'filament.components.item-image-gallery';

    public static function make(): static
    {
        return app(static::class);
    }

    public function getImages(): array
    {
        $record = $this->getRecord();
        if (!$record || !$record->images) {
            return [];
        }

        $images = [];
        $imageProcessingService = app(ImageProcessingService::class);

        foreach ($record->images as $hash => $sizes) {
            $thumbUrl = $sizes['thumb'] ?? null;
            if ($thumbUrl) {
                $images[] = [
                    'hash' => $hash,
                    'thumb' => $thumbUrl,
                    'small' => $sizes['small'] ?? $thumbUrl,
                    'large' => $sizes['large'] ?? $thumbUrl,
                ];
            }
        }

        return $images;
    }
}