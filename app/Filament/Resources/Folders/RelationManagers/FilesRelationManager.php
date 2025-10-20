<?php

namespace App\Filament\Resources\Folders\RelationManagers;

use Filament\Actions\Action as FilamentAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FilesRelationManager extends RelationManager
{
    protected static string $relationship = 'files';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
            ])
            ->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Stack::make([
                    ImageColumn::make('path')
                        ->disk('public')
                        ->height(200)
                        ->width(200)
                        ->extraAttributes(['class' => 'rounded-lg object-cover'])
                        ->grow(false)
                        ->alignCenter()
                        ->visible(fn ($record) => $record && $record->is_image),
                    TextColumn::make('extension')
                        ->badge()
                        ->color('primary')
                        ->size('lg')
                        ->weight('bold')
                        ->formatStateUsing(fn ($state) => '.' . strtoupper($state))
                        ->alignCenter()
                        ->visible(fn ($record) => $record && !$record->is_image),
                    TextColumn::make('title')
                        ->searchable()
                        ->sortable()
                        ->weight('semibold')
                        ->alignCenter(),
                    TextColumn::make('size')
                        ->formatStateUsing(fn ($state) => $this->formatBytes($state))
                        ->color('gray')
                        ->alignCenter(),
                ])->space(2),
            ])
            ->contentGrid([
                'sm' => 1,
                'md' => 2,
                'lg' => 3,
                'xl' => 4,
                '2xl' => 5,
            ])
            ->paginated([12, 24, 48, 96])
            ->filters([
                //
            ])
            ->headerActions([
                FilamentAction::make('uploadFiles')
                    ->label('Upload Files')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->form([
                        FileUpload::make('files')
                            ->label('Files')
                            ->multiple()
                            ->disk('public')
                            ->directory('media')
                            ->downloadable()
                            ->openable()
                            ->reorderable()
                            ->maxSize(10240)
                            ->helperText('Upload files to this folder. Drag and drop multiple files at once. Max 10MB per file.')
                            ->required(),
                    ])
                    ->action(function (array $data, RelationManager $livewire): void {
                        $folder = $livewire->getOwnerRecord();

                        foreach ($data['files'] as $file) {
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                            $fileName = pathinfo($file, PATHINFO_FILENAME);
                            $fileSize = \Illuminate\Support\Facades\Storage::disk('public')->size($file);
                            $mimeType = \Illuminate\Support\Facades\Storage::disk('public')->mimeType($file);
                            $isImage = str_starts_with($mimeType, 'image/');

                            $folder->files()->create([
                                'title' => $fileName,
                                'path' => $file,
                                'extension' => $extension,
                                'size' => $fileSize,
                                'mime_type' => $mimeType,
                                'is_image' => $isImage,
                            ]);
                        }

                        Notification::make()
                            ->title('Files uploaded successfully')
                            ->success()
                            ->send();
                    })
                    ->modalWidth('lg'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
