<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div class="space-y-4">
        {{-- File Upload Area --}}
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6">
            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="mt-4">
                    <label class="cursor-pointer">
                        <span class="mt-2 block text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('Upload images') }}
                        </span>
                        <input 
                            type="file" 
                            class="sr-only" 
                            multiple 
                            accept="image/*"
                            wire:model="{{ $getStatePath() }}"
                        >
                    </label>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        PNG, JPG, GIF up to 10MB each. Images will be converted to WebP format.
                    </p>
                </div>
            </div>
        </div>

        {{-- Image Preview Grid --}}
        @if($getUploadedFileUrls())
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($getUploadedFileUrls() as $hash => $thumbUrl)
                    <div class="relative group">
                        <div class="aspect-square bg-gray-100 dark:bg-gray-800 rounded-lg overflow-hidden">
                            <img 
                                src="{{ $thumbUrl }}" 
                                alt="Image thumbnail"
                                class="w-full h-full object-cover"
                            >
                        </div>
                        
                        {{-- Delete Button --}}
                        <button 
                            type="button"
                            class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity"
                            wire:click="removeUploadedFile('{{ $hash }}')"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        
                        {{-- Image Info --}}
                        <div class="mt-2">
                            <p class="text-xs text-gray-500 dark:text-gray-400 font-mono">
                                {{ substr($hash, 0, 8) }}...
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Loading State --}}
        <div wire:loading wire:target="{{ $getStatePath() }}" class="text-center py-4">
            <div class="inline-flex items-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-sm text-gray-500 dark:text-gray-400">Processing images...</span>
            </div>
        </div>
    </div>
</x-dynamic-component>