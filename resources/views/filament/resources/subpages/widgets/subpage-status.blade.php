@php
    $record = $this->record;
    $page = $record->page;
    $language = $record->language;
    $menus = $page?->menuItems()->with('menu')->get()->pluck('menu.name')->unique()->filter()->values();
@endphp

<x-filament::section>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Page</div>
            <div class="text-base font-semibold text-gray-900 dark:text-white">{{ $page?->pagename ?? 'N/A' }}</div>
        </div>
        
        <div>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Language</div>
            <div class="text-base font-semibold text-gray-900 dark:text-white">{{ $language?->name ?? 'N/A' }}</div>
        </div>
        
        <div>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Menus</div>
            <div class="text-base font-semibold text-gray-900 dark:text-white">
                @if($menus->isNotEmpty())
                    {{ $menus->implode(', ') }}
                @else
                    None
                @endif
            </div>
        </div>
    </div>
</x-filament::section>
