<?php

namespace App\Filament\Resources\Menus\RelationManagers;

use App\Models\Page;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class MenuItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'menuItems';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Menu Item')
                    ->schema([
                        Select::make('page_id')
                            ->label('Page')
                            ->options(fn () => $this->getParentPageOptions())
                            ->nullable()
                            ->searchable()
                            ->preload()
                            ->placeholder('Select page (optional)')
                            ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                if (blank($state)) {
                                    return;
                                }

                                $current = $get('slug');

                                if (filled($current)) {
                                    return;
                                }

                                $page = Page::find($state);

                                if (! $page) {
                                    return;
                                }

                                $suggestion = $this->generateSlugSuggestion($page);

                                if (! $suggestion) {
                                    return;
                                }

                                $set('slug', $suggestion);
                            }),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->suffixAction(
                                Action::make('suggestSlug')
                                    ->label('Suggest slug')
                                    ->button()
                                    ->color('gray')
                                    ->icon('heroicon-m-sparkles')
                                    ->tooltip('Suggest slug from page title')
                                    ->action(function (Set $set, Get $get) {
                                        $pageId = $get('page_id');

                                        if (! $pageId) {
                                            return;
                                        }

                                        $page = Page::find($pageId);

                                        if (! $page) {
                                            return;
                                        }

                                        $suggestion = $this->generateSlugSuggestion($page);

                                        if (! $suggestion) {
                                            return;
                                        }

                                        $set('slug', $suggestion);
                                    })
                            ,
                                true
                            )
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? Str::slug($state) : $state),
                    ])
                    ->columns(1)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('slug')
            ->columns([
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('page.meta_title')
                    ->label('Page')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable(),
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
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'asc');
    }

    protected function getParentPageOptions(): array
    {
        return Page::query()
            ->orderBy('pagename')
            ->get()
            ->mapWithKeys(function (Page $page) {
                $label = $page->meta_title ?: $page->pagename ?: 'Page #' . $page->id;

                return [$page->id => $label];
            })
            ->all();
    }

    protected function generateSlugSuggestion(Page $page): ?string
    {
        $title = $page->meta_title ?: $page->pagename;

        if (! $title) {
            return null;
        }

        return Str::slug($title);
    }
}
