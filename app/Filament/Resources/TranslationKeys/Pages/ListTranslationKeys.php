<?php

namespace App\Filament\Resources\TranslationKeys\Pages;

use App\Filament\Resources\TranslationKeys\TranslationKeyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTranslationKeys extends ListRecords
{
    protected static string $resource = TranslationKeyResource::class;
    public function getMaxContentWidth(): ?string
    {
        return "full";
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
