<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Page;
use App\Models\Subpage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FooterPagesSeeder extends Seeder
{
    public function run(): void
    {
        $filePath = database_path('import/footer-pages.json');

        if (!File::exists($filePath)) {
            $this->command?->error("Footer pages import file not found at {$filePath}.");
            return;
        }

        $payload = json_decode(File::get($filePath), true);

        if (!is_array($payload)) {
            $this->command?->error('Footer pages JSON is invalid or empty.');
            return;
        }

        $english = Language::where('code', 'en')->first();

        if (!$english) {
            $this->command?->error('English language (code: en) is required before running the footer pages seeder.');
            return;
        }

        $languageMap = [
            'norwegian' => Language::where('code', 'no')->first(),
            'swedish' => Language::where('code', 'se')->first(),
            'danish' => Language::whereIn('code', ['da', 'dk'])->first(),
            'finnish' => Language::where('code', 'fi')->first(),
        ];

        foreach ($languageMap as $key => $language) {
            if (!$language) {
                $this->command?->warn("Skipping {$key} translations because the language is not configured.");
            }
        }

        foreach ($payload as $groupName => $entries) {
            if (!is_array($entries) || empty($entries)) {
                continue;
            }

            foreach ($entries as $entry) {
                if (!is_array($entry) || empty($entry['english'])) {
                    continue;
                }

                $englishTitle = trim($entry['english']);
                $pageSlug = Str::slug($groupName . '-' . $englishTitle);

                $page = Page::firstOrCreate(
                    ['pagename' => $pageSlug],
                    ['meta_title' => $englishTitle]
                );

                $englishSubpage = Subpage::updateOrCreate(
                    [
                        'page_id' => $page->id,
                        'language_id' => $english->id,
                    ],
                    [
                        'title' => $englishTitle,
                        'pid' => null,
                    ]
                );

                foreach ($languageMap as $key => $language) {
                    if (!$language) {
                        continue;
                    }

                    $translatedTitle = $entry[$key] ?? null;

                    if (!$translatedTitle) {
                        continue;
                    }

                    Subpage::updateOrCreate(
                        [
                            'page_id' => $page->id,
                            'language_id' => $language->id,
                        ],
                        [
                            'title' => trim($translatedTitle),
                            'pid' => $englishSubpage->id,
                        ]
                    );
                }
            }
        }
    }
}
