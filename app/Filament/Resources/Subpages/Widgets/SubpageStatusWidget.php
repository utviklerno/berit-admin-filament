<?php

namespace App\Filament\Resources\Subpages\Widgets;

use Filament\Widgets\Widget;

class SubpageStatusWidget extends Widget
{
    protected string $view = 'filament.resources.subpages.widgets.subpage-status';

    protected int | string | array $columnSpan = 'full';

    public $record;
}
