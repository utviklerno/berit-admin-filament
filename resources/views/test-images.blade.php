<!DOCTYPE html>
<html>
<head>
    <title>Test Images</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-8">
    <h1 class="text-2xl mb-4">Test Image Gallery</h1>
    
    @php
        $item = App\Models\UserItem::find(6);
        $images = [];
        
        if ($item && $item->images) {
            foreach ($item->images as $hash => $sizes) {
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

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($images as $image)
            <div class="relative group bg-gray-100 rounded-lg p-2">
                <img 
                    src="{{ $image['thumb'] }}" 
                    alt="Item image"
                    class="w-full h-32 object-cover rounded"
                >
                
                <!-- Always visible delete button for testing -->
                <button 
                    onclick="testDelete('{{ $image['hash'] }}')"
                    class="mt-2 w-full bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm"
                >
                    Delete {{ substr($image['hash'], 0, 8) }}...
                </button>
                
                <!-- Hover delete button -->
                <div class="absolute top-2 right-2 bg-red-500 rounded-full p-1 opacity-70 group-hover:opacity-100">
                    <button 
                        onclick="testDelete('{{ $image['hash'] }}')"
                        class="text-white"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function testDelete(hash) {
            alert('Delete clicked for hash: ' + hash);
            
            if (confirm('Really delete image ' + hash.substring(0, 8) + '...?')) {
                fetch('/admin/items/6/delete-image', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ hash: hash })
                })
                .then(response => response.json())
                .then(data => {
                    alert('Result: ' + JSON.stringify(data));
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                    alert('Error: ' + error);
                });
            }
        }
    </script>
</body>
</html>