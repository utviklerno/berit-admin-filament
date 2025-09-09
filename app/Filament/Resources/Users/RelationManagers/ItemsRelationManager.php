<?php

namespace App\Filament\Resources\Users\RelationManagers;

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
use App\Models\UserLocation;

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
                    ->rows(3),
                Select::make('id_product_type')
                    ->label('Product Type')
                    ->options(ProductType::pluck('name', 'id'))
                    ->required()
                    ->reactive(),
                Select::make('id_product_type_item')
                    ->label('Product Type Item')
                    ->options(function (callable $get) {
                        $productTypeId = $get('id_product_type');
                        if (!$productTypeId) {
                            return [];
                        }
                        return ProductTypeItem::where('type_id', $productTypeId)->pluck('name', 'id');
                    })
                    ->required(),
                Select::make('id_user_location')
                    ->label('Location')
                    ->options(function () {
                        $userId = request()->route('record');
                        return UserLocation::where('user_id', $userId)->pluck('name', 'id');
                    })
                    ->required(),
                TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->prefix('$'),
                Select::make('price_interval_type')
                    ->options([
                        'hour' => 'Hour',
                        'day' => 'Day',
                        'week' => 'Week',
                        'month' => 'Month',
                        'year' => 'Year',
                    ])
                    ->required(),
                TextInput::make('price_interval_count')
                    ->numeric()
                    ->required()
                    ->default(1),
                TextInput::make('pri')
                    ->label('Priority')
                    ->numeric(),
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
                    ->limit(50)
                    ->toggleable(),
                TextColumn::make('productType.name')
                    ->label('Product Type')
                    ->sortable(),
                TextColumn::make('productTypeItem.name')
                    ->label('Product Item')
                    ->sortable(),
                TextColumn::make('location.name')
                    ->label('Location')
                    ->sortable(),
                TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('price_interval_type')
                    ->label('Interval')
                    ->badge(),
                TextColumn::make('price_interval_count')
                    ->label('Count'),
                IconColumn::make('active')
                    ->boolean(),
                TextColumn::make('images_count')
                    ->counts('images')
                    ->label('Images')
                    ->badge(),
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
            ->defaultSort('created_at', 'desc');
    }
}
