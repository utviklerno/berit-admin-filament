<?php

namespace App\Filament\Resources\ActivityLogs\Schemas;

use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ActivityLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Activity Details')
                    ->schema([
                        TextEntry::make('adminUser.name')
                            ->label('Admin User'),
                        TextEntry::make('action')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'created' => 'success',
                                'updated' => 'warning',
                                'deleted' => 'danger',
                                default => 'gray',
                            }),
                        TextEntry::make('description'),
                        TextEntry::make('subject_type')
                            ->label('Subject Type')
                            ->formatStateUsing(fn (string $state): string => class_basename($state)),
                        TextEntry::make('subject_id')
                            ->label('Subject ID'),
                        TextEntry::make('created_at')
                            ->label('Timestamp')
                            ->dateTime(),
                    ])
                    ->columns(2),
                Section::make('Additional Properties')
                    ->schema([
                        KeyValueEntry::make('properties')
                            ->label('')
                            ->hiddenLabel(),
                    ])
                    ->visible(fn ($record) => !empty($record->properties)),
            ]);
    }
}
