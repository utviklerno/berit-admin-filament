@props(['record'])

@php
    $page = $record->page;
    $language = $record->language;
    $menus = $page?->menuItems()->with('menu')->get()->pluck('menu.name')->unique()->filter();
@endphp

<div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Page</div>
            <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $page?->pagename ?? 'N/A' }}</div>
        </div>
        
        <div>
            <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Language</div>
            <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $language?->name ?? 'N/A' }}</div>
        </div>
        
        <div>
            <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Menus</div>
            <div class="text-sm font-semibold text-gray-900 dark:text-white">
                @if($menus && $menus->isNotEmpty())
                    {{ $menus->implode(', ') }}
                @else
                    <span class="text-gray-400">None</span>
                @endif
            </div>
        </div>
    </div>
</div>
