<?php

namespace App\Filament\Resources\Items\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use App\Models\ProductType;
use App\Models\ProductTypeItem;
use App\Models\User;
use App\Models\UserLocation;

class ItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_user')
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),
                Select::make('id_user_location')
                    ->label('Location')
                    ->options(function (callable $get) {
                        $userId = $get('id_user');
                        if ($userId) {
                            return UserLocation::where('id_user', $userId)
                                ->get()
                                ->pluck('name', 'id');
                        }
                        return UserLocation::all()->pluck('name', 'id');
                    })
                    ->required()
                    ->searchable(),
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
}