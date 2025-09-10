<?php

namespace App\Filament\Resources\Translations\Pages;

use App\Filament\Resources\Translations\TranslationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\TranslationCategory;
use App\Models\Language;
use Illuminate\Support\Facades\File;
use Filament\Notifications\Notification;

class ListTranslations extends ListRecords
{
    protected static string $resource = TranslationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('publishTranslations')
                ->label('Publish Translations')
                ->icon('heroicon-o-document-arrow-up')
                ->color('success')
                ->action(function () {
                    $this->publishTranslationFiles();
                })
                ->requiresConfirmation()
                ->modalHeading('Publish Translation Files')
                ->modalDescription('This will generate translation files from the database and overwrite existing files. Are you sure you want to continue?'),
            Actions\CreateAction::make(),
        ];
    }

    protected function publishTranslationFiles(): void
    {
        $languages = Language::where('is_active', true)->get();
        $categories = TranslationCategory::with(['translationKeys.translationValues.language'])->get();
        
        $publishedFiles = 0;

        foreach ($languages as $language) {
            $translations = [];
            
            // Build translation array structure
            foreach ($categories as $category) {
                $categoryTranslations = [];
                
                foreach ($category->translationKeys as $key) {
                    $translationValue = $key->translationValues
                        ->where('language_id', $language->id)
                        ->where('status', 'published')
                        ->first();
                    
                    if ($translationValue) {
                        $categoryTranslations[$key->key] = $translationValue->value;
                    }
                }
                
                if (!empty($categoryTranslations)) {
                    $translations[$category->key] = $categoryTranslations;
                }
            }

            // Add root-level translations (not in categories)
            foreach ($categories as $category) {
                foreach ($category->translationKeys as $key) {
                    // Add root-level keys that should not be in arrays
                    if (in_array($key->key, ['back', 'your_profile', 'services', 'get_started', 'about_berit', 'personal_information', 'permanent_address_info', 'first_name', 'last_name', 'email_address', 'country', 'street_address', 'postal_code', 'city', 'county', 'cancel', 'save', 'Current language'])) {
                        $translationValue = $key->translationValues
                            ->where('language_id', $language->id)
                            ->where('status', 'published')
                            ->first();
                        
                        if ($translationValue) {
                            $translations[$key->key] = $translationValue->value;
                        }
                    }
                }
            }

            // Create the file content
            $fileContent = $this->generateTranslationFileContent($translations, $language);
            
            // Ensure directory exists
            $langDir = resource_path("lang/{$language->code}");
            if (!File::exists($langDir)) {
                File::makeDirectory($langDir, 0755, true);
            }
            
            // Write the file
            $filePath = "{$langDir}/translation.php";
            File::put($filePath, $fileContent);
            
            $publishedFiles++;
        }

        Notification::make()
            ->title('Translation Files Published')
            ->body("Successfully published {$publishedFiles} translation files.")
            ->success()
            ->send();
    }

    protected function generateTranslationFileContent(array $translations, Language $language): string
    {
        $languageName = $language->name;
        
        $content = "<?php\n\nreturn [\n\n";
        $content .= "    /*\n";
        $content .= "    |--------------------------------------------------------------------------\n";
        $content .= "    | Translation File ({$languageName})\n";
        $content .= "    |--------------------------------------------------------------------------\n";
        $content .= "    |\n";
        $content .= "    | This language file contains the translations for the main menu items,\n";
        $content .= "    | personal information section, form labels, countries, and buttons.\n";
        $content .= "    | Generated from database on " . now()->format('Y-m-d H:i:s') . "\n";
        $content .= "    |\n";
        $content .= "    */\n\n";

        // Add category-based translations
        foreach ($translations as $key => $value) {
            if (is_array($value)) {
                $content .= "    // {$key}\n";
                $content .= "    '{$key}' => [\n";
                foreach ($value as $subKey => $subValue) {
                    $escapedValue = addslashes($subValue);
                    $content .= "        '{$subKey}' => '{$escapedValue}',\n";
                }
                $content .= "    ],\n\n";
            }
        }

        // Add root-level translations
        $rootKeys = ['back', 'your_profile', 'services', 'get_started', 'about_berit', 'personal_information', 'permanent_address_info', 'first_name', 'last_name', 'email_address', 'country', 'street_address', 'postal_code', 'city', 'county', 'cancel', 'save', 'Current language'];
        
        $content .= "    // Root-level translations\n";
        foreach ($rootKeys as $rootKey) {
            if (isset($translations[$rootKey]) && !is_array($translations[$rootKey])) {
                $escapedValue = addslashes($translations[$rootKey]);
                $content .= "    '{$rootKey}' => '{$escapedValue}',\n";
            }
        }

        $content .= "\n];\n";
        
        return $content;
    }
}