<?php

namespace App\Filament\Resources\Languages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Support\Colors\Color;

class LanguagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable()
                    ->width(70),
                TextColumn::make('flag_emoji')
                    ->label('')
                    ->width(50),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->native_name),
                TextColumn::make('code')
                    ->label('Code')
                    ->badge()
                    ->color('gray')
                    ->searchable(),
                IconColumn::make('is_default')
                    ->label('Default')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('')
                    ->trueColor(Color::Amber),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                TextColumn::make('completion_percentage')
                    ->label('Complete')
                    ->suffix('%')
                    ->color(fn ($record) => $record->completion_percentage >= 80 ? 'success' : ($record->completion_percentage >= 50 ? 'warning' : 'danger'))
                    ->sortable(),
                TextColumn::make('currency_code')
                    ->label('Currency')
                    ->badge()
                    ->color('blue')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active Languages'),
                TernaryFilter::make('is_default')
                    ->label('Default Language'),
            ])
            ->actions([
                Action::make('makeDefault')
                    ->label('Set Default')
                    ->icon('heroicon-o-star')
                    ->color('warning')
                    ->action(function ($record) {
                        $record->makeDefault();
                    })
                    ->visible(fn ($record) => !$record->is_default)
                    ->requiresConfirmation(),
                EditAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        if (!$record->canBeDeleted()) {
                            throw new \Exception('This language cannot be deleted.');
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