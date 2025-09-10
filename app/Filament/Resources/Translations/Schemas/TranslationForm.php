<?php

namespace App\Filament\Resources\Translations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class TranslationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->required()
                    ->maxLength(100)
                    ->label('Category Key')
                    ->helperText('Unique identifier (e.g., "categories", "navigation")')
                    ->unique(ignoreRecord: true),
                TextInput::make('name')
                    ->required()
                    ->maxLength(150)
                    ->label('Display Name')
                    ->helperText('Human readable name'),
                Textarea::make('description')
                    ->label('Description')
                    ->helperText('What translations this category contains'),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->label('Sort Order'),
                Select::make('group')
                    ->options([
                        'UI' => 'User Interface',
                        'Content' => 'Content',
                        'System' => 'System Messages',
                        'Forms' => 'Form Labels',
                        'Navigation' => 'Navigation',
                    ])
                    ->label('Group'),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
                Toggle::make('is_system')
                    ->label('System Category')
                    ->helperText('System categories cannot be deleted'),
                Textarea::make('notes')
                    ->label('Admin Notes')
                    ->rows(3),
            ]);
    }
}