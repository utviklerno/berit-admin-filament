<?php

namespace App\Filament\Resources\TranslationKeys\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class TranslationKeysTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('key')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('full_key')
                    ->label('Full Key')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
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
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),
                
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
            ->defaultSort('category.name');
    }
}