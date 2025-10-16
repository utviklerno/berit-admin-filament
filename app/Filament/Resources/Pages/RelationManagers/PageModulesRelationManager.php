<?php

namespace App\Filament\Resources\Pages\RelationManagers;

use App\Models\PageModule;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PageModulesRelationManager extends RelationManager
{
    protected static string $relationship = 'modules';

    protected static ?string $title = 'Content Modules';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Module')
                    ->schema([
                        TextInput::make('title')
                            ->label('Module title')
                            ->maxLength(255)
                            ->placeholder('Optional label for internal reference'),
                        Select::make('type')
                            ->label('Module type')
                            ->options(PageModule::availableTypes())
                            ->required()
                            ->live(),
                        TextInput::make('priority')
                            ->label('Order')
                            ->numeric()
                            ->required()
                            ->default(fn () => $this->getNextPriority()),
                        RichEditor::make('html')
                            ->label('Content')
                            ->visible(fn (Get $get) => $get('type') === PageModule::TYPE_RICH_TEXT)
                            ->columnSpanFull(),
                        TextInput::make('json.header_text')
                            ->label('Header text')
                            ->visible(fn (Get $get) => $get('type') === PageModule::TYPE_HEADER)
                            ->maxLength(255)
                            ->reactive()
                            ->afterStateUpdated(function (Set $set, Get $get, ?string $state): void {
                                if ($get('type') !== PageModule::TYPE_HEADER) {
                                    return;
                                }

                                $set('html', filled($state) ? sprintf('<h2>%s</h2>', e($state)) : null);
                            }),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('priority')
                    ->label('Order')
                    ->sortable()
                    ->width('80px'),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => Str::headline(str_replace('_', ' ', $state)))
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Title')
                    ->placeholder('—')
                    ->wrap(),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->since()
                    ->sortable(),
            ])
            ->reorderable('priority')
            ->headerActions([
                CreateAction::make()
                    ->label('Add module')
                    ->icon('heroicon-m-plus')
                    ->slideOver()
                    ->modalWidth('5xl')
                    ->modalHeading('Add module')
                    ->mutateFormDataUsing(fn (array $data): array => $this->transformFormData($data)),
            ])
            ->recordActions([
                EditAction::make()
                    ->slideOver()
                    ->modalWidth('5xl')
                    ->mutateFormDataUsing(fn (array $data): array => $this->transformFormData($data))
                    ->fillForm(function (array $data): array {
                        $data['json'] = Arr::wrap($data['json'] ?? []);

                        if (($data['type'] ?? null) === PageModule::TYPE_HEADER) {
                            $data['json']['header_text'] = Arr::get($data['json'], 'header_text', strip_tags($data['html'] ?? ''));
                        }

                        return $data;
                    }),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('priority')
            ->defaultSort('id');
    }

    protected function getNextPriority(): int
    {
        $last = $this->getOwnerRecord()->modules()->orderByDesc('priority')->first();

        return $last ? ((int) $last->priority + 10) : 10;
    }

    protected function transformFormData(array $data): array
    {
        $type = $data['type'] ?? null;

        if ($type === PageModule::TYPE_HEADER) {
            $headerText = trim((string) Arr::get($data, 'json.header_text'));
            $data['json'] = $headerText !== '' ? ['header_text' => $headerText] : null;
            $data['html'] = $headerText !== '' ? sprintf('<h2>%s</h2>', $headerText) : null;
        } elseif ($type !== PageModule::TYPE_RICH_TEXT) {
            $data['json'] = null;
        }

        Arr::forget($data, 'json.header_text');

        return $data;
    }
}
