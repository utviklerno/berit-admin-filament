<?php

namespace App\Filament\Resources\ProductTypes\Pages;

use App\Filament\Resources\ProductTypes\ProductTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductTypes extends ListRecords
{
    protected static string $resource = ProductTypeResource::class;
    public function getMaxContentWidth(): ?string
    {
        return "full";
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
