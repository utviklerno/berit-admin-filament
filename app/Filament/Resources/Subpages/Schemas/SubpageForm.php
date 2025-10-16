<?php

namespace App\Filament\Resources\Subpages\Schemas;

use App\Models\Language;
use App\Models\Page;
use App\Models\Subpage;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class SubpageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make("SubpageTabs")
                ->columns(4)
                ->maxWidth("max-w-7xl")
                ->tabs([
                    Tab::make("Content")->schema([
                        RichEditor::make("html")
                            ->label("Content")
                            ->nullable()
                            ->toolbarButtons([
                                ["bold", "italic", "link", "h2", "h3"],
                                ["grid", "attachFiles"],
                            ])
                            ->columnSpan(3),
                    ]),
                    Tab::make("Settings")->schema([
                        Section::make("Subpage")
                            ->schema([
                                Select::make("page_id")
                                    ->relationship("page", "pagename")
                                    ->label("Page")
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->live()
                                    ->default(
                                        fn(
                                            ?int $recordPageId,
                                        ) => request()->integer("page_id") ??
                                            $recordPageId,
                                    ),
                                Select::make("language_id")
                                    ->label("Language")
                                    ->required()
                                    ->options(function (Get $get) {
                                        $languages = Language::query()
                                            ->orderBy("sort_order")
                                            ->orderBy("name")
                                            ->get();

                                        $pageId = $get("page_id");

                                        if (!$pageId) {
                                            return $languages
                                                ->mapWithKeys(
                                                    fn($language) => [
                                                        $language->id =>
                                                            $language->display_name,
                                                    ],
                                                )
                                                ->all();
                                        }

                                        $available = $languages->mapWithKeys(
                                            fn($language) => [
                                                $language->id =>
                                                    $language->display_name,
                                            ],
                                        );

                                        $query = Page::find($pageId)
                                            ?->subpages()
                                            ->getQuery();

                                        $recordId =
                                            $get("id") ??
                                            request()->route("record");

                                        if ($recordId instanceof Subpage) {
                                            $recordId = $recordId->getKey();
                                        }

                                        if (
                                            is_string($recordId) &&
                                            ctype_digit($recordId)
                                        ) {
                                            $recordId = (int) $recordId;
                                        }

                                        if (is_int($recordId)) {
                                            $query?->whereKeyNot($recordId);
                                        }

                                        $used =
                                            $query
                                                ?->pluck("language_id")
                                                ->all() ?? [];

                                        return $available
                                            ->reject(
                                                fn($label, $id) => in_array(
                                                    (int) $id,
                                                    $used,
                                                    true,
                                                ),
                                            )
                                            ->all();
                                    })
                                    ->placeholder("Select language")
                                    ->preload()
                                    ->searchable()
                                    ->live()
                                    ->rule(function (Get $get) {
                                        $pageId = $get("page_id");

                                        if (!$pageId) {
                                            return null;
                                        }

                                        $recordId =
                                            $get("id") ??
                                            request()->route("record");

                                        if ($recordId instanceof Subpage) {
                                            $recordId = $recordId->getKey();
                                        }

                                        if (
                                            is_string($recordId) &&
                                            ctype_digit($recordId)
                                        ) {
                                            $recordId = (int) $recordId;
                                        }

                                        return Rule::unique(
                                            "subpages",
                                            "language_id",
                                        )
                                            ->where("page_id", $pageId)
                                            ->ignore($recordId);
                                    }),
                                TextInput::make("title")
                                    ->label("Title")
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make("description")
                                    ->label("Description")
                                    ->rows(3),
                                TextInput::make("meta_title")
                                    ->label("Meta Title")
                                    ->maxLength(255)
                                    ->nullable(),
                                Textarea::make("meta_description")
                                    ->label("Meta Description")
                                    ->rows(3)
                                    ->nullable(),
                                TagsInput::make("meta_keywords")
                                    ->label("Meta Keywords")
                                    ->splitKeys([","])
                                    ->reorderable()
                                    ->nullable(),
                                FileUpload::make("meta_image")
                                    ->label("Meta Image")
                                    ->directory("meta-images")
                                    ->image()
                                    ->maxSize(5120)
                                    ->nullable(),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),
                    Tab::make("Meta")
                        ->schema([
                            Section::make("Timestamps")
                                ->schema([
                                    DateTimePicker::make("created_at")
                                        ->label("Created at")
                                        ->disabled()
                                        ->dehydrated(false)
                                        ->visible(
                                            fn(?string $state) => filled(
                                                $state,
                                            ),
                                        ),
                                    DateTimePicker::make("updated_at")
                                        ->label("Updated at")
                                        ->disabled()
                                        ->dehydrated(false)
                                        ->visible(
                                            fn(?string $state) => filled(
                                                $state,
                                            ),
                                        ),
                                ])
                                ->columns(2)
                                ->columnSpanFull(),
                        ])
                        ->hidden(),
                ])
                ->columnSpanFull(),
        ]);
    }
}
