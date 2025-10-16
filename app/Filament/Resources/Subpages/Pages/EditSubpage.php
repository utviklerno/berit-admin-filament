<?php

namespace App\Filament\Resources\Subpages\Pages;

use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\Subpages\SubpageResource;
use Filament\Resources\Pages\EditRecord;

class EditSubpage extends EditRecord
{
    protected static string $resource = SubpageResource::class;
    public function getMaxContentWidth(): ?string
    {
        return "full";
    }

    public function getBreadcrumbs(): array
    {
        $page = $this->record->page;

        if (! $page) {
            return parent::getBreadcrumbs();
        }

        return [
            PageResource::getUrl() => PageResource::getBreadcrumb(),
            PageResource::getUrl('edit', ['record' => $page]) => PageResource::getRecordTitle($page),
            SubpageResource::getUrl('index', ['page_id' => $page->getKey()]) => SubpageResource::getBreadcrumb(),
            $this->getBreadcrumb(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return SubpageResource::getUrl('edit', array_filter([
            'record' => $this->record,
            'page_id' => $this->record->page_id,
        ]));
    }
}
