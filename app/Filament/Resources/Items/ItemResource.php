<?php

namespace App\Filament\Resources\Items;

use App\Filament\Resources\Items\Pages\CreateItem;
use App\Filament\Resources\Items\Pages\EditItem;
use App\Filament\Resources\Items\Pages\ListItems;
use App\Filament\Resources\Items\Schemas\ItemForm;
use App\Filament\Resources\Items\Tables\ItemsTable;
use App\Models\UserItem;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use BackedEnum;

class ItemResource extends Resource
{
    protected static ?string $model = UserItem::class;
    protected static string|BackedEnum|null $navigationIcon = "icon-folder";

    protected static ?string $navigationLabel = "Items";

    protected static ?string $modelLabel = "Item";

    protected static ?string $pluralModelLabel = "Items";

    public static function getNavigationGroup(): ?string
    {
        return "Management";
    }

    public static function getNavigationSort(): ?int
    {
        return 3;
    }

    public static function form(Schema $schema): Schema
    {
        return ItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ItemsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            "index" => ListItems::route("/"),
            "create" => CreateItem::route("/create"),
            "edit" => EditItem::route("/{record}/edit"),
        ];
    }
}
