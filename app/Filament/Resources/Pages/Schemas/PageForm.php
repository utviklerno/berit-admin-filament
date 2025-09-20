<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Page')
                    ->schema([
                        TextInput::make('pagename')
                            ->label('Page Name')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(255)
                            ->nullable(),
                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(3)
                            ->nullable(),
                        TagsInput::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->helperText('Used when a language doesn\'t specify its own keywords')
                            ->splitKeys([','])
                            ->reorderable()
                            ->nullable(),
                        FileUpload::make('meta_image')
                            ->label('Meta Image')
                            ->directory('meta-images')
                            ->image()
                            ->maxSize(5120)
                            ->nullable(),
                    ])
                    ->columns(1)
                    ->columnSpanFull(),
            ]);
    }
}
