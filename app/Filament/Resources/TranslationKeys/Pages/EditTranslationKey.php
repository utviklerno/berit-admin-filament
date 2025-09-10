<?php

namespace App\Filament\Resources\TranslationKeys\Pages;

use App\Filament\Resources\TranslationKeys\TranslationKeyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTranslationKey extends EditRecord
{
    protected static string $resource = TranslationKeyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Ensure full_key is populated
        if (isset($data['category_id']) && isset($data['key'])) {
            $category = \App\Models\TranslationCategory::find($data['category_id']);
            if ($category) {
                $data['full_key'] = $category->key . '.' . $data['key'];
            }
        }
        
        return $data;
    }
}