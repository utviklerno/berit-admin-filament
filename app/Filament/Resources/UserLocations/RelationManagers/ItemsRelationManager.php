<?php

namespace App\Filament\Resources\UserLocations\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use App\Models\ProductType;
use App\Models\ProductTypeItem;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->maxLength(255),
                Select::make('id_product_type')
                    ->label('Product Type')
                    ->options(ProductType::all()->pluck('name', 'id'))
                    ->required(),
                Select::make('id_product_type_item')
                    ->label('Product Type Item')
                    ->options(ProductTypeItem::all()->pluck('name', 'id'))
                    ->required(),
                TextInput::make('price')
                    ->numeric()
                    ->required(),
                Select::make('price_interval_type')
                    ->options([
                        'day' => 'Day',
                        'week' => 'Week',
                        'month' => 'Month',
                        'year' => 'Year',
                    ])
                    ->required(),
                TextInput::make('price_interval_count')
                    ->numeric()
                    ->default(1)
                    ->required(),
                TextInput::make('pri')
                    ->label('Priority')
                    ->numeric()
                    ->default(0),
                Toggle::make('active')
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->searchable()
                    ->limit(40)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 40) {
                            return null;
                        }
                        return $state;
                    }),
                TextColumn::make('productType.name')
                    ->label('Product Type')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('productTypeItem.name')
                    ->label('Product Item')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                TextColumn::make('price_interval_count')
                    ->label('Per')
                    ->formatStateUsing(fn ($state, $record) => $state . ' ' . str($record->price_interval_type)->plural($state)),
                IconColumn::make('active')
                    ->boolean(),
                TextColumn::make('pri')
                    ->label('Priority')
                    ->sortable()
                    ->toggleable(),
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
