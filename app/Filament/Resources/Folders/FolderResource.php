<?php

namespace App\Filament\Resources\Folders;

use App\Filament\Resources\Folders\Pages\CreateFolder;
use App\Filament\Resources\Folders\Pages\EditFolder;
use App\Filament\Resources\Folders\Pages\ListFolders;
use App\Filament\Resources\Folders\Schemas\FolderForm;
use App\Filament\Resources\Folders\Tables\FoldersTable;
use App\Models\Folder;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FolderResource extends Resource
{
    protected static ?string $model = Folder::class;

    protected static string|BackedEnum|null $navigationIcon = null;

    public static function getNavigationGroup(): ?string
    {
        return "Media";
    }

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    public static function form(Schema $schema): Schema
    {
        return FolderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FoldersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [RelationManagers\FilesRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            "index" => ListFolders::route("/"),
            "create" => CreateFolder::route("/create"),
            "edit" => EditFolder::route("/{record}/edit"),
        ];
    }
}
