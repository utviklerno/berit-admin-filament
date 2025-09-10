<?php

namespace App\Filament\Resources\Translations\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class TranslationKeysRelationManager extends RelationManager
{
    protected static string $relationship = 'translationKeys';

    protected static ?string $title = 'Translation Keys';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                
                Textarea::make('description')
                    ->maxLength(500)
                    ->rows(3),
                
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
                
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
                
                Toggle::make('is_required')
                    ->default(true),
                
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('key')
            ->columns([
                TextColumn::make('key')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('full_key')
                    ->label('Full Key')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'text' => 'gray',
                        'html' => 'warning',
                        'markdown' => 'info',
                        'number' => 'success',
                        'boolean' => 'primary',
                        default => 'gray',
                    }),
                
                TextColumn::make('translation_count')
                    ->label('Translations')
                    ->alignCenter()
                    ->sortable(),
                
                TextColumn::make('completion_percentage')
                    ->label('Complete')
                    ->formatStateUsing(fn ($state) => round($state, 1) . '%')
                    ->color(fn ($state) => $state >= 100 ? 'success' : ($state >= 50 ? 'warning' : 'danger'))
                    ->alignCenter()
                    ->sortable(),
                
                IconColumn::make('is_required')
                    ->boolean()
                    ->alignCenter(),
                
                IconColumn::make('is_active')
                    ->boolean()
                    ->alignCenter(),
                
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'text' => 'Text',
                        'html' => 'HTML',
                        'markdown' => 'Markdown',
                        'number' => 'Number',
                        'boolean' => 'Boolean',
                    ]),
                
                TernaryFilter::make('is_required')
                    ->label('Required'),
                
                TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Edit Translations')
                    ->url(fn ($record) => route('filament.admin.resources.translation-keys.edit', $record))
                    ->icon('heroicon-o-language'),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order');
    }
}