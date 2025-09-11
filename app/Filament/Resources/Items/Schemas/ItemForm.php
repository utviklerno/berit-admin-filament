<?php

namespace App\Filament\Resources\Items\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\View;
use Filament\Schemas\Schema;
use App\Models\ProductType;
use App\Models\ProductTypeItem;
use App\Models\User;
use App\Models\UserLocation;
use App\Services\ImageProcessingService;

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
                            return UserLocation::where('user_id', $userId)
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
                    ->required()
                    ->reactive(),
                Select::make('id_product_type_item')
                    ->label('Product Type Item')
                    ->options(function (callable $get) {
                        $productTypeId = $get('id_product_type');
                        if ($productTypeId) {
                            return ProductTypeItem::where('product_type_id', $productTypeId)
                                ->get()
                                ->pluck('name', 'id');
                        }
                        return [];
                    })
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
                Section::make('Images')
                    ->schema([
                        FileUpload::make('temp_images')
                            ->label('Upload Images')
                            ->helperText('Upload images and save the form to process them into WebP format with multiple sizes')
                            ->image()
                            ->multiple()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                            ->maxSize(10240)
                            ->maxFiles(10)
                            ->disk('local')
                            ->directory('temp-uploads')
                            ->visibility('private')
                            ->previewable(false)
                            ->hiddenOn(['view'])
                            ->columnSpanFull(),
                        View::make('filament.components.item-image-gallery')
                            ->viewData(function ($record) {
                                return [
                                    'record' => $record,
                                    'getRecord' => function() use ($record) { return $record; }
                                ];
                            })
                            ->hiddenOn(['create'])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}