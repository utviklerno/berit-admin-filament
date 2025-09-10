<?php

namespace App\Filament\Resources\TranslationKeys\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TranslationKeyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Key Information')
                    ->schema([
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->preload(),
                        
                        TextInput::make('key')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('The key identifier for this translation'),
                        
                        TextInput::make('full_key')
                            ->label('Full Key')
                            ->disabled()
                            ->helperText('Auto-generated full key path'),
                        
                        Textarea::make('description')
                            ->maxLength(500)
                            ->rows(3)
                            ->helperText('Description of what this translation is used for'),
                        
                        Select::make('type')
                            ->options([
                                'text' => 'Text',
                                'html' => 'HTML',
                                'markdown' => 'Markdown',
                                'number' => 'Number',
                                'boolean' => 'Boolean',
                            ])
                            ->default('text')
                            ->required(),
                    ])
                    ->columns(1),
                
                Section::make('Settings')
                    ->schema([
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Order in which this key appears'),
                        
                        Toggle::make('is_required')
                            ->default(true)
                            ->inline()
                            ->helperText('Is this translation required?'),
                        
                        Toggle::make('is_system')
                            ->default(false)
                            ->inline()
                            ->helperText('Is this a system translation?'),
                        
                        Toggle::make('is_active')
                            ->default(true)
                            ->inline()
                            ->helperText('Is this translation active?'),
                    ])
                    ->columns(1),
            ]);
    }
}