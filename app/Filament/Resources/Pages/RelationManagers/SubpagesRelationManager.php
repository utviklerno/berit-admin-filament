<?php

namespace App\Filament\Resources\Pages\RelationManagers;

use App\Models\Language;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SubpagesRelationManager extends RelationManager
{
    protected static string $relationship = 'subpages';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Subpage')
                    ->schema([
                Select::make('language_id')
                    ->label('Language')
                    ->options(function () {
                        $owner = $this->getOwnerRecord();
                        $all = Language::query()
                            ->orderBy('sort_order')
                            ->orderBy('name')
                            ->get();

                        // Exclude languages already used in this page's subpages when creating
                        if ($owner) {
                            $used = $owner->subpages()->pluck('language_id')->all();
                            $all = $all->reject(fn ($lang) => in_array($lang->id, $used, true));
                        }

                        return $all->mapWithKeys(fn ($l) => [$l->id => $l->display_name])->toArray();
                    })
                    ->placeholder('Select language')
                    ->preload()
                    ->required()
                    ->disabledOn('edit'),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->rows(3)
                    ->nullable(),

                TextInput::make('meta_title')
                    ->label('Meta Title')
                    ->maxLength(255)
                    ->nullable(),
                Textarea::make('meta_description')
                    ->label('Meta Description')
                    ->rows(3)
                    ->nullable(),
                TagsInput::make('meta_keywords')
                    ->label('Meta Keywords')
                    ->splitKeys([','])
                    ->reorderable()
                    ->nullable(),
                FileUpload::make('meta_image')
                    ->label('Meta Image')
                    ->directory('meta-images')
                    ->image()
                    ->maxSize(5120)
                    ->nullable(),
                    ])
                    ->columns(1)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('id')->label('ID')->sortable()->width(70),
                TextColumn::make('language.display_name')->label('Language')->sortable(),
                TextColumn::make('title')->searchable()->sortable(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->slideOver()
                    ->modalWidth('7xl'),
            ])
            ->recordActions([
                EditAction::make()
                    ->slideOver()
                    ->modalWidth('7xl'),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }
}
