<?php

namespace App\Filament\Resources\TranslationKeys;

use App\Filament\Resources\TranslationKeys\Pages\ListTranslationKeys;
use App\Filament\Resources\TranslationKeys\Pages\CreateTranslationKey;
use App\Filament\Resources\TranslationKeys\Pages\EditTranslationKey;
use App\Filament\Resources\TranslationKeys\Schemas\TranslationKeyForm;
use App\Filament\Resources\TranslationKeys\Tables\TranslationKeysTable;
use App\Filament\Resources\Translations\RelationManagers\TranslationValuesRelationManager;
use App\Models\TranslationKey;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class TranslationKeyResource extends Resource
{
    protected static ?string $model = TranslationKey::class;

    protected static ?string $navigationLabel = 'Translation Keys';

    protected static ?string $modelLabel = 'Translation Key';

    protected static ?string $pluralModelLabel = 'Translation Keys';

    protected static bool $shouldRegisterNavigation = false; // Hide from main navigation

    public static function form(Schema $schema): Schema
    {
        return TranslationKeyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TranslationKeysTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            TranslationValuesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTranslationKeys::route('/'),
            'create' => CreateTranslationKey::route('/create'),
            'edit' => EditTranslationKey::route('/{record}/edit'),
        ];
    }
}