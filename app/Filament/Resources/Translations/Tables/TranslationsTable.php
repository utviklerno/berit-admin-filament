<?php

namespace App\Filament\Resources\Translations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class TranslationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable()
                    ->width(70),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->key),
                TextColumn::make('group')
                    ->badge()
                    ->color(fn ($record) => match($record->group) {
                        'UI' => 'blue',
                        'Content' => 'green',
                        'System' => 'red',
                        'Forms' => 'yellow',
                        'Navigation' => 'purple',
                        default => 'gray'
                    })
                    ->sortable(),
                TextColumn::make('total_keys')
                    ->label('Keys')
                    ->sortable(),
                TextColumn::make('completion_percentage')
                    ->label('Complete')
                    ->suffix('%')
                    ->color(fn ($record) => $record->completion_percentage >= 80 ? 'success' : ($record->completion_percentage >= 50 ? 'warning' : 'danger'))
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                IconColumn::make('is_system')
                    ->label('System')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('last_updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('group')
                    ->options([
                        'UI' => 'User Interface',
                        'Content' => 'Content',
                        'System' => 'System Messages',
                        'Forms' => 'Form Labels',
                        'Navigation' => 'Navigation',
                    ]),
                TernaryFilter::make('is_active')
                    ->label('Active Categories'),
                TernaryFilter::make('is_system')
                    ->label('System Categories'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        if ($record->is_system) {
                            throw new \Exception('System categories cannot be deleted.');
                        }
                        $record->delete();
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc');
    }
}