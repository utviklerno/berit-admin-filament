<?php

namespace App\Filament\Resources\UserLocations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use App\Models\User;

class UserLocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Location Details')
                    ->schema([
                        Select::make('user_id')
                            ->label('Owner')
                            ->options(User::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                        TextInput::make('name')
                            ->required()
                            ->placeholder('e.g., Home, Office, Warehouse'),
                        Toggle::make('is_primary')
                            ->label('Primary Location'),
                    ])
                    ->columns(3),
                
                Section::make('Address Information')
                    ->schema([
                        TextInput::make('street_address')
                            ->maxLength(255),
                        TextInput::make('unit_number')
                            ->maxLength(255),
                        TextInput::make('city')
                            ->maxLength(255),
                        TextInput::make('state')
                            ->maxLength(255),
                        TextInput::make('postal_code')
                            ->maxLength(255),
                        TextInput::make('country')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                
                Section::make('Contact & Additional Information')
                    ->schema([
                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),
                        Textarea::make('delivery_instructions')
                            ->rows(3),
                    ])
                    ->columns(2),
            ]);
    }
}
