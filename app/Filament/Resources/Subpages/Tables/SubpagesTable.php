<?php

namespace App\Filament\Resources\Subpages\Tables;

use App\Models\Language;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SubpagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page.pagename')
                    ->label('Page')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('language.display_name')
                    ->label('Language')
                    ->badge()
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('page_id')
                    ->relationship('page', 'pagename')
                    ->label('Page'),
                SelectFilter::make('language_id')
                    ->label('Language')
                    ->options(function () {
                        return Language::query()
                            ->ordered()
                            ->get()
                            ->mapWithKeys(fn (Language $language) => [
                                $language->id => $language->display_name,
                            ])->all();
                    }),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }
}
