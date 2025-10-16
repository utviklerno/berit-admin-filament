<?php

namespace App\Filament\Resources\Subpages\Pages;

use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\Subpages\SubpageResource;
use App\Models\Page;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubpages extends ListRecords
{
    protected static string $resource = SubpageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('create')
                ->label('Create subpage')
                ->icon('heroicon-m-plus')
                ->url(fn () => SubpageResource::getUrl('create', [
                    'page_id' => request()->integer('page_id'),
                ])),
        ];
    }

    public function getBreadcrumbs(): array
    {
        if (! ($page = $this->getContextPage())) {
            return parent::getBreadcrumbs();
        }

        return [
            PageResource::getUrl() => PageResource::getBreadcrumb(),
            PageResource::getUrl('edit', ['record' => $page]) => PageResource::getRecordTitle($page),
            $this->getBreadcrumb(),
        ];
    }

    protected function getContextPage(): ?Page
    {
        $pageId = request()->integer('page_id');

        if (! $pageId) {
            return null;
        }

        return Page::find($pageId);
    }
}
