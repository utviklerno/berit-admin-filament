<?php

namespace App\Filament\Resources\Menus;

use App\Filament\Resources\Menus\Pages\CreateMenu;
use App\Filament\Resources\Menus\Pages\EditMenu;
use App\Filament\Resources\Menus\Pages\ListMenus;
use App\Filament\Resources\Menus\RelationManagers\MenuItemsRelationManager;
use App\Filament\Resources\Menus\Schemas\MenuForm;
use App\Filament\Resources\Menus\Tables\MenusTable;
use App\Models\Menu;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use BackedEnum;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;
    protected static string|BackedEnum|null $navigationIcon = "icon-cards";

    protected static ?string $navigationLabel = "Menus";

    protected static ?string $modelLabel = "Menu";

    protected static ?string $pluralModelLabel = "Menus";

    public static function getNavigationGroup(): ?string
    {
        return "Site";
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public static function form(Schema $schema): Schema
    {
        return MenuForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MenusTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [MenuItemsRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            "index" => ListMenus::route("/"),
            "create" => CreateMenu::route("/create"),
            "edit" => EditMenu::route("/{record}/edit"),
        ];
    }
}
