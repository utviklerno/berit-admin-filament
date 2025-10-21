<?php

namespace App\Filament\Resources\ActivityLogs\Pages;

use App\Filament\Resources\ActivityLogs\ActivityLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListActivityLogs extends ListRecords
{
    protected static string $resource = ActivityLogResource::class;
    public function getMaxContentWidth(): ?string
    {
        return "full";
    }

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
