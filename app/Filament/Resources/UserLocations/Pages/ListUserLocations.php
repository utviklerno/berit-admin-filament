<?php

namespace App\Filament\Resources\UserLocations\Pages;

use App\Filament\Resources\UserLocations\UserLocationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserLocations extends ListRecords
{
    protected static string $resource = UserLocationResource::class;
    public function getMaxContentWidth(): ?string
    {
        return "full";
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
