<div class="space-y-4">
    @php
        $record = $getRecord();
        $images = [];
        
        if ($record && $record->images) {
            foreach ($record->images as $hash => $sizes) {
                $thumbUrl = $sizes['thumb'] ?? null;
                if ($thumbUrl) {
                    $images[] = [
                        'hash' => $hash,
                        'thumb' => $thumbUrl,
                        'small' => $sizes['small'] ?? $thumbUrl,
                        'large' => $sizes['large'] ?? $thumbUrl,
                    ];
                }
            }
        }
    @endphp

    @if(count($images) > 0)
        <div class="bg-white dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Item Images</h3>
            </div>
            
            <div class="p-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($images as $image)
                        <div class="relative group">
                            <div class="aspect-square bg-gray-100 dark:bg-gray-800 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                                <img 
                                    src="{{ $image['thumb'] }}" 
                                    alt="Item image"
                                    class="w-full h-full object-cover cursor-pointer hover:scale-105 transition-transform duration-200"
                                    onclick="openImageModal('{{ $image['large'] }}')"
                                >
                            </div>
                            <div class="mt-2 text-center">
                                <span class="text-xs text-gray-500 dark:text-gray-400 font-mono">
                                    {{ substr($image['hash'], 0, 8) }}...
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        {{-- Image Modal --}}
        <div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-75" onclick="closeImageModal()">
            <div class="max-w-4xl max-h-full p-4">
                <img id="modalImage" class="max-w-full max-h-full rounded-lg shadow-lg" alt="Full size image">
            </div>
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <script>
            function openImageModal(imageUrl) {
                const modal = document.getElementById('imageModal');
                const modalImage = document.getElementById('modalImage');
                modalImage.src = imageUrl;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeImageModal() {
                const modal = document.getElementById('imageModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        </script>
    @else
        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p class="mt-4 text-gray-500 dark:text-gray-400">No images uploaded for this item</p>
        </div>
    @endif
</div>