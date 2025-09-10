<?php

namespace App\Filament\Resources\Translations\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
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
use App\Models\Language;

class TranslationValuesRelationManager extends RelationManager
{
    protected static string $relationship = 'translationValues';

    protected static ?string $title = 'Translation Values';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('language_id')
                    ->relationship('language', 'name')
                    ->required()
                    ->preload(),
                
                Textarea::make('value')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                
                Textarea::make('value_html')
                    ->label('HTML Value')
                    ->helperText('Optional HTML version if different from plain text')
                    ->rows(3)
                    ->columnSpanFull(),
                
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'review' => 'Review',
                        'approved' => 'Approved',
                        'published' => 'Published',
                    ])
                    ->default('draft')
                    ->required(),
                
                Toggle::make('is_verified')
                    ->label('Verified by native speaker')
                    ->default(false),
                
                Toggle::make('is_ai_generated')
                    ->label('AI Generated')
                    ->default(false),
                
                Textarea::make('context_note')
                    ->label('Context Note')
                    ->helperText('Additional context for translators')
                    ->rows(2)
                    ->columnSpanFull(),
                
                TextInput::make('translator_name')
                    ->label('Translator Name')
                    ->maxLength(100),
                
                TextInput::make('translator_email')
                    ->label('Translator Email')
                    ->email()
                    ->maxLength(150),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('value')
            ->columns([
                TextColumn::make('language.name')
                    ->label('Language')
                    ->badge()
                    ->color(fn ($record) => match($record->language->code) {
                        'en' => 'primary',
                        'no' => 'success',
                        'sv' => 'warning',
                        'da' => 'info',
                        'fi' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                
                TextColumn::make('value')
                    ->label('Translation')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->value)
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'review' => 'warning',
                        'approved' => 'info',
                        'published' => 'success',
                        default => 'gray',
                    }),
                
                IconColumn::make('is_verified')
                    ->boolean()
                    ->label('Verified')
                    ->alignCenter(),
                
                IconColumn::make('is_ai_generated')
                    ->boolean()
                    ->label('AI')
                    ->alignCenter(),
                
                TextColumn::make('character_count')
                    ->label('Chars')
                    ->alignCenter()
                    ->sortable(),
                
                TextColumn::make('word_count')
                    ->label('Words')
                    ->alignCenter()
                    ->sortable(),
                
                TextColumn::make('translator_name')
                    ->label('Translator')
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('translated_at')
                    ->label('Translated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('language_id')
                    ->relationship('language', 'name')
                    ->label('Language'),
                
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'review' => 'Review',
                        'approved' => 'Approved',
                        'published' => 'Published',
                    ]),
                
                TernaryFilter::make('is_verified')
                    ->label('Verified'),
                
                TernaryFilter::make('is_ai_generated')
                    ->label('AI Generated'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['character_count'] = strlen($data['value']);
                        $data['word_count'] = str_word_count($data['value']);
                        $data['translated_at'] = now();
                        return $data;
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['character_count'] = strlen($data['value']);
                        $data['word_count'] = str_word_count($data['value']);
                        return $data;
                    }),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('language.name');
    }
}