<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        $languages = [
            [
                'name' => 'English',
                'native_name' => 'English',
                'code' => 'en',
                'iso_code' => 'en',
                'flag_emoji' => '🇬🇧',
                'is_active' => true,
                'is_default' => true,
                'is_fallback' => true,
                'sort_order' => 1,
                'region' => 'International',
                'country_code' => 'GB',
                'timezone' => 'UTC',
                'first_day_of_week' => 1,
                'currency_code' => 'GBP',
                'currency_symbol' => '£',
                'currency_position' => 'before',
                'currency_space' => false,
                'currency_decimals' => 2,
                'decimal_separator' => '.',
                'thousands_separator' => ',',
                'date_format' => 'd/m/Y',
                'time_format' => 'H:i',
                'datetime_format' => 'd/m/Y H:i',
                'locale_code' => 'en_GB',
                'collation' => 'utf8mb4_unicode_ci',
            ],
            [
                'name' => 'Norwegian',
                'native_name' => 'Norsk',
                'code' => 'no',
                'iso_code' => 'no',
                'flag_emoji' => '🇳🇴',
                'is_active' => true,
                'is_default' => false,
                'is_fallback' => false,
                'sort_order' => 2,
                'region' => 'Nordic',
                'country_code' => 'NO',
                'timezone' => 'Europe/Oslo',
                'first_day_of_week' => 1,
                'currency_code' => 'NOK',
                'currency_symbol' => 'kr',
                'currency_position' => 'after',
                'currency_space' => true,
                'currency_decimals' => 2,
                'decimal_separator' => ',',
                'thousands_separator' => ' ',
                'date_format' => 'd.m.Y',
                'time_format' => 'H:i',
                'datetime_format' => 'd.m.Y H:i',
                'locale_code' => 'nb_NO',
                'collation' => 'utf8mb4_norwegian_ci',
            ],
            [
                'name' => 'Swedish',
                'native_name' => 'Svenska',
                'code' => 'se',
                'iso_code' => 'sv',
                'flag_emoji' => '🇸🇪',
                'is_active' => true,
                'is_default' => false,
                'is_fallback' => false,
                'sort_order' => 3,
                'region' => 'Nordic',
                'country_code' => 'SE',
                'timezone' => 'Europe/Stockholm',
                'first_day_of_week' => 1,
                'currency_code' => 'SEK',
                'currency_symbol' => 'kr',
                'currency_position' => 'after',
                'currency_space' => true,
                'currency_decimals' => 2,
                'decimal_separator' => ',',
                'thousands_separator' => ' ',
                'date_format' => 'Y-m-d',
                'time_format' => 'H:i',
                'datetime_format' => 'Y-m-d H:i',
                'locale_code' => 'sv_SE',
                'collation' => 'utf8mb4_swedish_ci',
            ],
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }
    }
}