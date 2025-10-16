<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\Subpages\SubpageResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;
    public function getMaxContentWidth(): ?string
    {
        return "full";
    }

    protected function getHeaderActions(): array
    {
        return array_merge(
            parent::getHeaderActions(),
            [
                Action::make('manageSubpages')
                    ->label('Manage subpages')
                    ->icon('heroicon-o-squares-2x2')
                    ->url(fn () => SubpageResource::getUrl('index', [
                        'page_id' => $this->record->getKey(),
                    ])),
            ],
        );
    }
}

