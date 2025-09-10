<?php

namespace App\Filament\Resources\Languages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class LanguageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(100)
                    ->label('Name')
                    ->helperText('English name (e.g., "Norwegian")'),
                TextInput::make('native_name')
                    ->maxLength(100)
                    ->label('Native Name')
                    ->helperText('Name in the language itself (e.g., "Norsk")'),
                TextInput::make('code')
                    ->required()
                    ->maxLength(5)
                    ->label('Language Code')
                    ->helperText('ISO code (e.g., "no", "en")')
                    ->unique(ignoreRecord: true),
                TextInput::make('flag_emoji')
                    ->maxLength(10)
                    ->label('Flag Emoji')
                    ->helperText('Flag emoji (e.g., "🇳🇴")'),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->label('Sort Order'),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
                Toggle::make('is_default')
                    ->label('Default Language'),
                TextInput::make('currency_code')
                    ->maxLength(3)
                    ->label('Currency Code')
                    ->helperText('ISO currency code (e.g., "NOK")'),
                TextInput::make('currency_symbol')
                    ->maxLength(10)
                    ->label('Currency Symbol')
                    ->helperText('Currency symbol (e.g., "kr")'),
                TextInput::make('date_format')
                    ->default('Y-m-d')
                    ->label('Date Format')
                    ->helperText('PHP date format'),
                TextInput::make('time_format')
                    ->default('H:i')
                    ->label('Time Format')
                    ->helperText('PHP time format'),
            ]);
    }
}