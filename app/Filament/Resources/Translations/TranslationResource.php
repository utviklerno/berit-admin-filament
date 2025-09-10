<?php

namespace App\Filament\Resources\Translations;

use App\Filament\Resources\Translations\Pages\ListTranslations;
use App\Filament\Resources\Translations\Pages\CreateTranslation;
use App\Filament\Resources\Translations\Pages\EditTranslation;
use App\Filament\Resources\Translations\Tables\TranslationsTable;
use App\Filament\Resources\Translations\Schemas\TranslationForm;
use App\Filament\Resources\Translations\RelationManagers\TranslationKeysRelationManager;
use App\Models\TranslationCategory;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class TranslationResource extends Resource
{
    protected static ?string $model = TranslationCategory::class;

    protected static ?string $navigationLabel = 'Translations';

    protected static ?string $modelLabel = 'Translation Category';

    protected static ?string $pluralModelLabel = 'Translation Categories';

    public static function getNavigationGroup(): ?string
    {
        return 'Settings';
    }

    public static function getNavigationSort(): ?int
    {
        return 4;
    }

    public static function form(Schema $schema): Schema
    {
        return TranslationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TranslationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            TranslationKeysRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTranslations::route('/'),
            'create' => CreateTranslation::route('/create'),
            'edit' => EditTranslation::route('/{record}/edit'),
        ];
    }
}