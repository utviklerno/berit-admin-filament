<?php

namespace App\Filament\Resources\TranslationKeys\Pages;

use App\Filament\Resources\TranslationKeys\TranslationKeyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTranslationKey extends CreateRecord
{
    protected static string $resource = TranslationKeyResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Auto-generate full_key
        if (isset($data['category_id']) && isset($data['key'])) {
            $category = \App\Models\TranslationCategory::find($data['category_id']);
            if ($category) {
                $data['full_key'] = $category->key . '.' . $data['key'];
            }
        }
        
        return $data;
    }
}