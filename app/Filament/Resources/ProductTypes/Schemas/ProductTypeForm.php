<?php

namespace App\Filament\Resources\ProductTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProductTypeForm
{
    public static function configure(Schema $schema): Schema
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
            ]);
    }
}