<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;
use App\Models\TranslationCategory;
use App\Models\TranslationKey;
use App\Models\TranslationValue;
use Illuminate\Support\Facades\DB;

class TranslationSeeder extends Seeder
{
    public function run(): void
    {
        echo "Creating languages...\n";
        
        // Create languages first
        $languages = [
            [
                'id' => 1,
                'name' => 'English',
                'code' => 'en',
                'native_name' => 'English',
                'flag_emoji' => '🇺🇸',
                'is_active' => true,
                'is_default' => true,
                'currency_code' => 'USD',
                'currency_symbol' => '$',
                'date_format' => 'Y-m-d',
                'time_format' => 'H:i',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Norwegian',
                'code' => 'no',
                'native_name' => 'Norsk',
                'flag_emoji' => '🇳🇴',
                'is_active' => true,
                'is_default' => false,
                'currency_code' => 'NOK',
                'currency_symbol' => 'kr',
                'date_format' => 'd.m.Y',
                'time_format' => 'H:i',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('languages')->upsert($languages, ['id'], [
            'name', 'code', 'native_name', 'flag_emoji', 'is_active', 'is_default',
            'currency_code', 'currency_symbol', 'date_format', 'time_format', 'sort_order', 'updated_at'
        ]);

        echo "Creating translation categories...\n";

        // Create translation categories based on the file structure
        $categories = [
            [
                'id' => 1,
                'key' => 'categories',
                'name' => 'Categories',
                'description' => 'Storage and service category translations',
                'group' => 'Content',
                'sort_order' => 1,
                'is_active' => true,
                'is_system' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'key' => 'map',
                'name' => 'Map Interface',
                'description' => 'Map-related interface translations',
                'group' => 'UI',
                'sort_order' => 2,
                'is_active' => true,
                'is_system' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'key' => 'howto',
                'name' => 'How-to Links',
                'description' => 'Help and tutorial link translations',
                'group' => 'Content',
                'sort_order' => 3,
                'is_active' => true,
                'is_system' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'key' => 'search',
                'name' => 'Search Interface',
                'description' => 'Search functionality translations',
                'group' => 'UI',
                'sort_order' => 4,
                'is_active' => true,
                'is_system' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'key' => 'navigation',
                'name' => 'Navigation',
                'description' => 'Main navigation menu translations',
                'group' => 'Navigation',
                'sort_order' => 5,
                'is_active' => true,
                'is_system' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'key' => 'language_codes',
                'name' => 'Language Names',
                'description' => 'Language name translations',
                'group' => 'System',
                'sort_order' => 6,
                'is_active' => true,
                'is_system' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'key' => 'profile_menu',
                'name' => 'Profile Menu',
                'description' => 'User profile menu translations',
                'group' => 'Navigation',
                'sort_order' => 7,
                'is_active' => true,
                'is_system' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'key' => 'main_menu',
                'name' => 'Main Menu Items',
                'description' => 'Top-level menu item translations',
                'group' => 'Navigation',
                'sort_order' => 8,
                'is_active' => true,
                'is_system' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'key' => 'personal_info',
                'name' => 'Personal Information',
                'description' => 'Personal information section translations',
                'group' => 'Forms',
                'sort_order' => 9,
                'is_active' => true,
                'is_system' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'key' => 'form_labels',
                'name' => 'Form Labels',
                'description' => 'Form field label translations',
                'group' => 'Forms',
                'sort_order' => 10,
                'is_active' => true,
                'is_system' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'key' => 'countries',
                'name' => 'Countries',
                'description' => 'Country name translations',
                'group' => 'Content',
                'sort_order' => 11,
                'is_active' => true,
                'is_system' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'key' => 'buttons',
                'name' => 'Buttons',
                'description' => 'Button text translations',
                'group' => 'UI',
                'sort_order' => 12,
                'is_active' => true,
                'is_system' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('translation_categories')->upsert($categories, ['id'], [
            'key', 'name', 'description', 'group', 'sort_order', 'is_active', 'is_system', 'updated_at'
        ]);

        echo "Creating translation keys and values...\n";

        // Load the translation file data
        $translations = include(resource_path('lang/en/translation.php'));
        
        $translationKeys = [];
        $translationValues = [];
        $usedKeys = []; // Track category_id + key combinations to prevent duplicates
        $keyId = 1;
        $valueId = 1;

        // Process each category
        foreach ($translations as $categoryKey => $categoryData) {
            $category = collect($categories)->firstWhere('key', $categoryKey);
            if (!$category) {
                // Handle root-level keys (not in arrays)
                if (!is_array($categoryData)) {
                    $category = collect($categories)->firstWhere('key', 'main_menu');
                    if ($category) {
                        $this->addTranslationKeyIfUnique($translationKeys, $translationValues, $usedKeys, $keyId, $valueId, $category['id'], $categoryKey, $categoryData);
                    }
                }
                continue;
            }

            if (is_array($categoryData)) {
                $sortOrder = 1;
                foreach ($categoryData as $key => $value) {
                    $this->addTranslationKeyIfUnique($translationKeys, $translationValues, $usedKeys, $keyId, $valueId, $category['id'], $key, $value, $sortOrder++);
                }
            } else {
                $this->addTranslationKeyIfUnique($translationKeys, $translationValues, $usedKeys, $keyId, $valueId, $category['id'], $categoryKey, $categoryData);
            }
        }

        // Handle root level translations that don't fit in specific categories
        $rootTranslations = [
            'back' => 'Back',
            'your_profile' => 'Your Profile',
            'services' => 'Services',
            'get_started' => 'Get Started',
            'about_berit' => 'About Berit',
            'personal_information' => 'Personal Information',
            'permanent_address_info' => 'Use a permanent address where you can receive mail.',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email_address' => 'Email Address',
            'country' => 'Country',
            'street_address' => 'Street Address',
            'postal_code' => 'Postal Code',
            'city' => 'City',
            'county' => 'County',
            'cancel' => 'Cancel',
            'save' => 'Save',
            'Current language' => 'Current language',
        ];

        $sortOrder = 1;
        foreach ($rootTranslations as $key => $value) {
            if (in_array($key, ['first_name', 'last_name', 'email_address', 'country', 'street_address', 'postal_code', 'city', 'county'])) {
                $categoryId = 10; // form_labels
            } elseif (in_array($key, ['personal_information', 'permanent_address_info'])) {
                $categoryId = 9; // personal_info
            } elseif (in_array($key, ['cancel', 'save'])) {
                $categoryId = 12; // buttons
            } else {
                $categoryId = 8; // main_menu
            }
            $this->addTranslationKeyIfUnique($translationKeys, $translationValues, $usedKeys, $keyId, $valueId, $categoryId, $key, $value, $sortOrder++);
        }

        // Insert keys and values in chunks
        echo "Inserting " . count($translationKeys) . " translation keys...\n";
        $chunks = array_chunk($translationKeys, 100);
        foreach ($chunks as $chunk) {
            DB::table('translation_keys')->insert($chunk);
        }

        echo "Inserting " . count($translationValues) . " translation values...\n";
        $chunks = array_chunk($translationValues, 100);
        foreach ($chunks as $chunk) {
            DB::table('translation_values')->insert($chunk);
        }

        // Now add Norwegian translations
        echo "Adding Norwegian translations...\n";
        $this->addNorwegianTranslations();

        echo "TranslationSeeder completed successfully!\n";
        echo "Created " . count($categories) . " categories, " . count($translationKeys) . " keys, and " . count($translationValues) . " values.\n";
    }

    private function addTranslationKeyIfUnique(&$translationKeys, &$translationValues, &$usedKeys, &$keyId, &$valueId, $categoryId, $key, $value, $sortOrder = 0)
    {
        $uniqueKey = $categoryId . '-' . $key;
        
        // Skip if this category+key combination already exists
        if (isset($usedKeys[$uniqueKey])) {
            echo "Skipping duplicate key: $key in category $categoryId\n";
            return;
        }
        
        $usedKeys[$uniqueKey] = true;
        
        $fullKey = DB::table('translation_categories')->where('id', $categoryId)->value('key') . '.' . $key;
        
        $translationKeys[] = [
            'id' => $keyId,
            'category_id' => $categoryId,
            'key' => $key,
            'full_key' => $fullKey,
            'description' => 'Imported from translation file',
            'type' => 'text',
            'sort_order' => $sortOrder,
            'is_required' => true,
            'is_system' => true,
            'is_active' => true,
            'translation_count' => 1,
            'completion_percentage' => 100.0,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Add English translation value
        $translationValues[] = [
            'id' => $valueId,
            'translation_key_id' => $keyId,
            'language_id' => 1, // English
            'value' => $value,
            'status' => 'published',
            'is_verified' => true,
            'version' => 1,
            'character_count' => strlen($value),
            'word_count' => str_word_count($value),
            'translated_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $keyId++;
        $valueId++;
    }

    private function addNorwegianTranslations(): void
    {
        // Load Norwegian translation file
        $norwegianTranslations = include(resource_path('lang/no/translation.php'));
        
        // Get all translation keys from database
        $translationKeys = DB::table('translation_keys')->get(['id', 'category_id', 'key']);
        
        // Get existing Norwegian translations to avoid duplicates
        $existingTranslations = DB::table('translation_values')
            ->where('language_id', 2)
            ->pluck('translation_key_id')
            ->toArray();
        
        $norwegianValues = [];
        $valueId = DB::table('translation_values')->max('id') + 1;

        // Process each Norwegian translation
        foreach ($norwegianTranslations as $categoryKey => $categoryData) {
            if (is_array($categoryData)) {
                foreach ($categoryData as $key => $value) {
                    $this->addNorwegianValue($translationKeys, $norwegianValues, $valueId, $categoryKey, $key, $value, $existingTranslations);
                }
            } else {
                // Handle root-level keys - they should be in main_menu category
                $this->addNorwegianValue($translationKeys, $norwegianValues, $valueId, 'main_menu', $categoryKey, $categoryData, $existingTranslations);
            }
        }

        // Handle specific root translations
        $rootNorwegianTranslations = [
            'back' => 'Tilbake',
            'your_profile' => 'Din profil',
            'services' => 'Tjenester',
            'get_started' => 'Kom i gang',
            'about_berit' => 'Om Berit',
            'personal_information' => 'Personlig informasjon',
            'permanent_address_info' => 'Bruk en permanent adresse hvor du kan motta post.',
            'first_name' => 'Fornavn',
            'last_name' => 'Etternavn',
            'email_address' => 'E-postadresse',
            'country' => 'Land',
            'street_address' => 'Gateadresse',
            'postal_code' => 'Postnummer',
            'city' => 'By',
            'county' => 'Fylke',
            'cancel' => 'Avbryt',
            'save' => 'Lagre',
            'Current language' => 'Gjeldende språk',
        ];

        foreach ($rootNorwegianTranslations as $key => $value) {
            // Determine which category this key belongs to
            if (in_array($key, ['first_name', 'last_name', 'email_address', 'country', 'street_address', 'postal_code', 'city', 'county'])) {
                $categoryKey = 'form_labels';
            } elseif (in_array($key, ['personal_information', 'permanent_address_info'])) {
                $categoryKey = 'personal_info';
            } elseif (in_array($key, ['cancel', 'save'])) {
                $categoryKey = 'buttons';
            } else {
                $categoryKey = 'main_menu';
            }
            $this->addNorwegianValue($translationKeys, $norwegianValues, $valueId, $categoryKey, $key, $value, $existingTranslations);
        }

        // Insert Norwegian values
        if (!empty($norwegianValues)) {
            echo "Inserting " . count($norwegianValues) . " Norwegian translation values...\n";
            $chunks = array_chunk($norwegianValues, 100);
            foreach ($chunks as $chunk) {
                DB::table('translation_values')->insert($chunk);
            }
        }
    }

    private function addNorwegianValue($translationKeys, &$norwegianValues, &$valueId, $categoryKey, $key, $value, &$existingTranslations): void
    {
        // Find the category ID
        $categoryId = DB::table('translation_categories')->where('key', $categoryKey)->value('id');
        if (!$categoryId) {
            return;
        }

        // Find the translation key
        $translationKey = $translationKeys->where('category_id', $categoryId)->where('key', $key)->first();
        if (!$translationKey) {
            return;
        }

        // Check if Norwegian translation already exists (either from DB or already processed)
        if (in_array($translationKey->id, $existingTranslations)) {
            return;
        }

        // Add to existing translations to prevent duplicates within this run
        $existingTranslations[] = $translationKey->id;

        $norwegianValues[] = [
            'id' => $valueId,
            'translation_key_id' => $translationKey->id,
            'language_id' => 2, // Norwegian
            'value' => $value,
            'status' => 'published',
            'is_verified' => true,
            'version' => 1,
            'character_count' => strlen($value),
            'word_count' => str_word_count($value),
            'translated_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $valueId++;
    }
}
