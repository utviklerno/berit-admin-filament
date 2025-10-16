<?php

namespace App\Filament\Resources\Pages\RelationManagers;

use App\Filament\Resources\Subpages\SubpageResource;
use App\Models\Language;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SubpagesRelationManager extends RelationManager
{
    protected static string $relationship = 'subpages';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('SubpageTabs')
                    ->tabs([
                        Tab::make('Settings')
                            ->schema([
                                Section::make('Subpage')
                                    ->schema([
                                        Select::make('language_id')
                                            ->label('Language')
                                            ->options(function ($record) {
                                                $owner = $this->getOwnerRecord();
                                                $all = Language::query()
                                                    ->orderBy('sort_order')
                                                    ->orderBy('name')
                                                    ->get();

                                                if ($record && $record->language_id) {
                                                    return $all->mapWithKeys(fn ($l) => [$l->id => $l->display_name])->toArray();
                                                }

                                                if ($owner) {
                                                    $used = $owner->subpages()->pluck('language_id')->all();
                                                    $all = $all->reject(fn ($lang) => in_array($lang->id, $used, true));
                                                }

                                                return $all->mapWithKeys(fn ($l) => [$l->id => $l->display_name])->toArray();
                                            })
                                            ->placeholder('Select language')
                                            ->preload()
                                            ->required()
                                            ->disabled(fn ($record) => $record && $record->exists && $record->language_id),

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
                            ]),
                        Tab::make('Content')
                            ->schema([
                                Section::make('Content')
                                    ->schema([
                                        RichEditor::make('html')
                                            ->label('Content')
                                            ->nullable()
                                            ->toolbarButtons([
                                                ['bold', 'italic', 'link', 'h2', 'h3'],
                                                ['grid', 'attachFiles'],
                                            ])
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(1)
                                    ->columnSpanFull(),
                            ]),
                    ])
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
                Action::make('createSubpage')
                    ->label('Create subpage')
                    ->icon('heroicon-m-plus')
                    ->url(fn (): string => SubpageResource::getUrl('create', [
                        'page_id' => $this->getOwnerRecord()->getKey(),
                    ]))
                    ->openUrlInNewTab(false),
            ])
            ->recordActions([
                Action::make('editSubpage')
                    ->label('Edit')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn ($record): string => SubpageResource::getUrl('edit', [
                        'record' => $record,
                    ]))
                    ->openUrlInNewTab(false),
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
