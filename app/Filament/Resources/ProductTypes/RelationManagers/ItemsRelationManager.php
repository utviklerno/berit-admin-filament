<?php

namespace App\Filament\Resources\ProductTypes\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Name'),
                TextInput::make('pri')
                    ->label('Priority')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear first'),
                Textarea::make('description')
                    ->maxLength(500)
                    ->label('Description')
                    ->nullable(),
                TextInput::make('price')
                    ->label('Default Price (øre)')
                    ->numeric()
                    ->helperText('Price in øre (e.g., 10000 = 100 kr)')
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('pri')
                    ->label('Priority')
                    ->sortable()
                    ->width(80),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('price')
                    ->label('Default Price')
                    ->money('NOK', divideBy: 100)
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('userItems_count')
                    ->counts('userItems')
                    ->label('Usage')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('pri', 'asc');
    }
}