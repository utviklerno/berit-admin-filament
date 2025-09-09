<?php

namespace App\Filament\Resources\UserLocations;

use App\Filament\Resources\UserLocations\Pages\CreateUserLocation;
use App\Filament\Resources\UserLocations\Pages\EditUserLocation;
use App\Filament\Resources\UserLocations\Pages\ListUserLocations;

use App\Filament\Resources\UserLocations\Schemas\UserLocationForm;
use App\Filament\Resources\UserLocations\Tables\UserLocationsTable;
use App\Models\UserLocation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserLocationResource extends Resource
{
    protected static ?string $model = UserLocation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;
    
    protected static ?string $navigationLabel = 'Locations';
    
    protected static ?string $modelLabel = 'Location';
    
    protected static ?string $pluralModelLabel = 'Locations';

    public static function form(Schema $schema): Schema
    {
        return UserLocationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserLocationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUserLocations::route('/'),
            'create' => CreateUserLocation::route('/create'),
            'edit' => EditUserLocation::route('/{record}/edit'),
        ];
    }
}
