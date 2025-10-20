<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\RichEditor;

class MediaRichEditor extends RichEditor
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->extraAttributes([
            'data-has-media-browser' => true,
        ]);
    }
}
