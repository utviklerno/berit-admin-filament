<?php

namespace App\Filament\Resources\Subpages;

use App\Filament\Resources\Subpages\Pages\CreateSubpage;
use App\Filament\Resources\Subpages\Pages\EditSubpage;
use App\Filament\Resources\Subpages\Pages\ListSubpages;
use App\Filament\Resources\Subpages\Schemas\SubpageForm;
use App\Filament\Resources\Subpages\Tables\SubpagesTable;
use App\Models\Subpage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SubpageResource extends Resource
{
    protected static ?string $model = Subpage::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-document-text';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $breadcrumb = 'Subpages';

    public static function form(Schema $schema): Schema
    {
        return SubpageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubpagesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubpages::route('/'),
            'create' => CreateSubpage::route('/create'),
            'edit' => EditSubpage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->when(request()->filled('page_id'), fn (Builder $query) => $query->where('page_id', request()->integer('page_id')));
    }
}
