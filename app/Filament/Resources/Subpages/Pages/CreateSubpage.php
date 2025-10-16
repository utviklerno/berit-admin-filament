<?php

namespace App\Filament\Resources\Subpages\Pages;

use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\Subpages\SubpageResource;
use App\Models\Page;
use Filament\Resources\Pages\CreateRecord;

class CreateSubpage extends CreateRecord
{
    protected static string $resource = SubpageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['page_id'] = $data['page_id'] ?? request()->integer('page_id');

        return $data;
    }

    public function getBreadcrumbs(): array
    {
        if (! ($page = $this->getContextPage())) {
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
        $pageId = $this->record?->page_id ?? request()->integer('page_id');

        return SubpageResource::getUrl('edit', array_filter([
            'record' => $this->record,
            'page_id' => $pageId,
        ]));
    }

    protected function getContextPage(): ?Page
    {
        $pageId = request()->integer('page_id');

        if (! $pageId && $this->record) {
            $pageId = $this->record->page_id;
        }

        if (! $pageId) {
            return null;
        }

        return Page::find($pageId);
    }
}
