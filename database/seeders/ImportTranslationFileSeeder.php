<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\TranslationCategory;
use App\Models\TranslationKey;
use App\Models\TranslationValue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ImportTranslationFileSeeder extends Seeder
{
    public function run(): void
    {
        // Load the translation file
        $translations = require resource_path('lang/en/translation.php');
        
        // Get the English language
        $englishLanguage = Language::where('code', 'en')->first();
        
        if (!$englishLanguage) {
            $this->command->error('English language not found. Please run LanguageSeeder first.');
            return;
        }
        
        // Track processed keys to avoid duplicates
        $processedKeys = [];
        
        // Process each category
        foreach ($translations as $categoryKey => $categoryData) {
            if (is_array($categoryData)) {
                // Create or update category
                $category = $this->createCategory($categoryKey);
                
                // Process translations within this category
                $this->processTranslations($categoryData, $category, $englishLanguage, $categoryKey);
            } else {
                // Root level translations - put them in a 'general' category
                // But skip if we've already processed this key in a category
                $fullKey = "general.{$categoryKey}";
                if (!in_array($fullKey, $processedKeys)) {
                    $generalCategory = $this->createCategory('general');
                    $this->createTranslation($categoryKey, $categoryData, $generalCategory, $englishLanguage, $fullKey);
                    $processedKeys[] = $fullKey;
                }
            }
        }
        
        // Update completion percentages
        $this->updateCompletionPercentages();
        
        $this->command->info('Translation import completed successfully!');
    }
    
    private function createCategory(string $key): TranslationCategory
    {
        $name = ucwords(str_replace(['_', '-'], ' ', $key));
        
        return TranslationCategory::firstOrCreate(
            ['key' => $key],
            [
                'name' => $name,
                'description' => "Translations for {$name}",
                'icon' => $this->getCategoryIcon($key),
                'color' => $this->getCategoryColor($key),
                'group' => $this->getCategoryGroup($key),
                'sort_order' => $this->getCategorySortOrder($key),
                'is_system' => false,
                'is_active' => true,
            ]
        );
    }
    
    private function processTranslations(array $translations, TranslationCategory $category, Language $language, string $categoryKey): void
    {
        foreach ($translations as $key => $value) {
            if (is_array($value)) {
                // Nested translations - process recursively with compound keys
                foreach ($value as $subKey => $subValue) {
                    $fullKey = "{$categoryKey}.{$key}.{$subKey}";
                    $this->createTranslation($subKey, $subValue, $category, $language, $fullKey);
                }
            } else {
                $fullKey = "{$categoryKey}.{$key}";
                $this->createTranslation($key, $value, $category, $language, $fullKey);
            }
        }
    }
    
    private function createTranslation(string $key, string $value, TranslationCategory $category, Language $language, string $fullKey): void
    {
        // Create or update translation key
        $translationKey = TranslationKey::firstOrCreate(
            [
                'category_id' => $category->id,
                'key' => $key,
            ],
            [
                'full_key' => $fullKey,
                'description' => $this->generateDescription($key, $value),
                'type' => $this->determineType($value),
                'context' => $this->determineContext($key, $category->key),
                'is_required' => true,
                'is_system' => false,
                'is_active' => true,
                'is_deprecated' => false,
            ]
        );
        
        // Create or update translation value for English
        TranslationValue::updateOrCreate(
            [
                'translation_key_id' => $translationKey->id,
                'language_id' => $language->id,
            ],
            [
                'value' => $value,
                'status' => 'published',
                'is_verified' => true,
                'is_ai_generated' => false,
                'needs_review' => false,
                'character_count' => strlen($value),
                'word_count' => str_word_count($value),
                'translated_at' => now(),
            ]
        );
    }
    
    private function generateDescription(string $key, string $value): string
    {
        $keyWords = ucwords(str_replace(['_', '-'], ' ', $key));
        return "Translation for '{$keyWords}' - Default: \"{$value}\"";
    }
    
    private function determineType(string $value): string
    {
        if (strlen($value) > 100) {
            return 'text';
        } elseif (str_contains($value, "\n")) {
            return 'multiline';
        } else {
            return 'string';
        }
    }
    
    private function determineContext(string $key, string $category): string
    {
        $contexts = [
            'button' => 'UI Button',
            'label' => 'Form Label',
            'title' => 'Page Title',
            'message' => 'User Message',
            'error' => 'Error Message',
            'success' => 'Success Message',
            'placeholder' => 'Input Placeholder',
            'navigation' => 'Navigation Item',
            'menu' => 'Menu Item',
        ];
        
        foreach ($contexts as $pattern => $context) {
            if (str_contains(strtolower($key), $pattern) || str_contains(strtolower($category), $pattern)) {
                return $context;
            }
        }
        
        return 'General';
    }
    
    private function getCategoryIcon(string $key): string
    {
        $icons = [
            'categories' => 'heroicon-o-folder',
            'map' => 'heroicon-o-map',
            'howto' => 'heroicon-o-question-mark-circle',
            'search' => 'heroicon-o-magnifying-glass',
            'navigation' => 'heroicon-o-bars-3',
            'language_codes' => 'heroicon-o-language',
            'profile_menu' => 'heroicon-o-user-circle',
            'main_menu' => 'heroicon-o-queue-list',
            'personal_info' => 'heroicon-o-user',
            'form_labels' => 'heroicon-o-document-text',
            'countries' => 'heroicon-o-globe-alt',
            'buttons' => 'heroicon-o-cursor-arrow-rays',
            'general' => 'heroicon-o-document',
        ];
        
        return $icons[$key] ?? 'heroicon-o-document';
    }
    
    private function getCategoryColor(string $key): string
    {
        $colors = [
            'categories' => 'primary',
            'map' => 'success',
            'howto' => 'info',
            'search' => 'warning',
            'navigation' => 'gray',
            'language_codes' => 'purple',
            'profile_menu' => 'blue',
            'main_menu' => 'indigo',
            'personal_info' => 'pink',
            'form_labels' => 'yellow',
            'countries' => 'green',
            'buttons' => 'red',
            'general' => 'gray',
        ];
        
        return $colors[$key] ?? 'gray';
    }
    
    private function getCategoryGroup(string $key): string
    {
        $groups = [
            'categories' => 'Content',
            'map' => 'Features',
            'howto' => 'Help',
            'search' => 'Features',
            'navigation' => 'UI',
            'language_codes' => 'System',
            'profile_menu' => 'User',
            'main_menu' => 'UI',
            'personal_info' => 'User',
            'form_labels' => 'Forms',
            'countries' => 'System',
            'buttons' => 'UI',
            'general' => 'General',
        ];
        
        return $groups[$key] ?? 'General';
    }
    
    private function getCategorySortOrder(string $key): int
    {
        $order = [
            'navigation' => 1,
            'main_menu' => 2,
            'profile_menu' => 3,
            'categories' => 4,
            'search' => 5,
            'map' => 6,
            'howto' => 7,
            'personal_info' => 8,
            'form_labels' => 9,
            'buttons' => 10,
            'countries' => 11,
            'language_codes' => 12,
            'general' => 99,
        ];
        
        return $order[$key] ?? 50;
    }
    
    private function updateCompletionPercentages(): void
    {
        // Update category completion percentages
        $categories = TranslationCategory::all();
        foreach ($categories as $category) {
            $totalKeys = $category->translationKeys()->where('is_active', true)->count();
            if ($totalKeys > 0) {
                $completedKeys = $category->translationKeys()
                    ->where('is_active', true)
                    ->whereHas('translationValues', function ($query) {
                        $query->where('status', 'published');
                    })
                    ->count();
                
                $category->total_keys = $totalKeys;
                $category->completion_percentage = ($completedKeys / $totalKeys) * 100;
                $category->last_updated_at = now();
                $category->save();
            }
        }
        
        // Update language completion percentages
        $languages = Language::all();
        foreach ($languages as $language) {
            $language->updateCompletionPercentage();
        }
    }
}