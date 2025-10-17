<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label("Name")
                    ->getStateUsing(
                        fn($record) => trim(
                            $record->name . " " . $record->lastname,
                        ),
                    )
                    ->searchable(["name", "lastname"])
                    ->sortable(),

                TextColumn::make("email")
                    ->label("Email address")
                    ->searchable()
                    ->sortable(),
                TextColumn::make("phone")
                    ->searchable()
                    ->toggleable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make("mobile")
                    ->searchable()
                    ->toggleable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make("email_verified_at")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make("is_admin")
                    ->label("Admin")
                    ->formatStateUsing(
                        fn($state) => view("components.custom-icon", [
                            "class" => "centered-icon",
                            "name" => $state ? "check-circle" : "x-circle",
                        ])->render(),
                    )
                    ->html()
                    ->alignCenter(),

                TextColumn::make("has_profile")
                    ->label("Profile")
                    ->getStateUsing(fn($record) => $record->profile !== null)
                    ->formatStateUsing(
                        fn($state) => view("components.custom-icon", [
                            "class" => "centered-icon",
                            "name" => $state ? "check-circle" : "x-circle",
                        ])->render(),
                    )
                    ->html()
                    ->alignCenter(),

                TextColumn::make("locations_count")
                    ->counts("locations")
                    ->label("Locations")
                    ->badge(),
                TextColumn::make("items_count")
                    ->counts("items")
                    ->label("Items")
                    ->badge(),
                TextColumn::make("created_at")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make("updated_at")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make("is_admin")
                    ->label("Admin Users")
                    ->query(fn($query) => $query->where("is_admin", true)),
                Filter::make("has_profile")
                    ->label("Has Profile")
                    ->query(fn($query) => $query->whereHas("profile")),
                Filter::make("has_items")
                    ->label("Has Items")
                    ->query(fn($query) => $query->whereHas("items")),
            ])
            ->recordActions([ViewAction::make(), EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ])
            ->defaultSort("created_at", "desc");
    }
}
