<div class="space-y-4" x-data="imageGallery()" x-init="
    // Ensure CSRF token meta tag exists
    if (!document.querySelector('meta[name=csrf-token]')) {
        const meta = document.createElement('meta');
        meta.name = 'csrf-token';
        meta.content = '{{ csrf_token() }}';
        document.head.appendChild(meta);
    }
">
    @php
        // Try multiple ways to get the record
        $record = $record ?? (isset($getRecord) && is_callable($getRecord) ? $getRecord() : null);
        
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
        
        $recordId = $record ? $record->id : 0;
    @endphp

    @if(count($images) > 0)
        <div class="berit-card">
            <div class="berit-card-header">
                <h3 class="berit-form-section-title">Item Images</h3>
                <p class="berit-help-text">Drag to reorder priority</p>
            </div>

            <div class="berit-card-body">
                <div 
                    class="berit-image-gallery" 
                    id="sortable-images"
                    x-ref="sortableContainer"
                >
                    @foreach($images as $index => $image)
                        <div 
                            class="berit-image-item draggable-item cursor-move" 
                            draggable="true"
                            data-hash="{{ $image['hash'] }}"
                            x-on:dragstart="dragStart($event)"
                            x-on:dragover.prevent
                            x-on:dragenter.prevent="dragEnter($event)"
                            x-on:dragleave="dragLeave($event)"
                            x-on:drop="drop($event)"
                            x-on:dragend="dragEnd($event)"
                        >
                            <img 
                                src="{{ $image['thumb'] }}" 
                                alt="Item image"
                                class="w-full h-full object-cover pointer-events-none select-none"
                            >
                            
                            {{-- Priority Badge --}}
                            <div class="berit-priority-badge">
                                {{ $index + 1 }}
                            </div>
                            
                            {{-- Drag Handle --}}
                            <div class="berit-drag-handle">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                                </svg>
                            </div>
                            
                            {{-- Delete Button --}}
                            <button 
                                onclick="deleteImage('{{ $image['hash'] }}')"
                                class="berit-delete-button"
                                title="Delete image ({{ substr($image['hash'], 0, 8) }}...)"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                            
                            {{-- Image Overlay --}}
                            <div class="berit-image-overlay">
                                <div class="berit-image-actions">
                                    <button 
                                        onclick="openImageModal('{{ $image['large'] }}')"
                                        class="bg-white text-gray-800 px-3 py-1 rounded hover:bg-gray-100 transition-colors"
                                    >
                                        View
                                    </button>
                                </div>
                            </div>

                            {{-- Priority Badge --}}
                            <div class="absolute -top-2 -left-2 bg-blue-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">
                                {{ $index + 1 }}
                            </div>

                            {{-- Drag Handle --}}
                            <div style="width:50px;" class="absolute top-2 right-2 bg-black bg-opacity-50 rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                                </svg>
                            </div>

                            {{-- View Button --}}
                            <div class="absolute bottom-2 right-2 bg-black bg-opacity-50 rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button
                                    onclick="openImageModal('{{ $image['large'] }}')"
                                    class="text-white hover:text-gray-300"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>

                            {{-- Delete Button --}}
                            <div class="absolute top-2 left-2 bg-red-500 hover:bg-red-600 rounded-full p-2 opacity-70 hover:opacity-100 group-hover:opacity-100 transition-all duration-200 shadow-lg z-10">
                                <button 
                                    onclick="deleteImage('{{ $image['hash'] }}')"
                                    class="text-white hover:text-red-100 transition-colors duration-150 flex items-center justify-center"
                                    title="Delete image ({{ substr($image['hash'], 0, 8) }}...)"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>

                            <div class="mt-2 text-center">
                                <span class="text-xs text-gray-500 dark:text-gray-400 font-mono">
                                    {{ substr($image['hash'], 0, 8) }}...
                                </span>
                                <div class="mt-1">
                                    <button 
                                        onclick="deleteImage('{{ $image['hash'] }}')"
                                        class="text-xs bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded transition-colors"
                                        title="Delete this image"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Save Order Button --}}
                <div class="mt-4 text-center" x-show="orderChanged" x-transition>
                    <button
                        @click="saveOrder()"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors"
                    >
                        Save New Order
                    </button>
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
            function imageGallery() {
                return {
                    orderChanged: false,
                    draggedElement: null,

                    dragStart(e) {
                        this.draggedElement = e.target.closest('.draggable-item');
                        e.target.style.opacity = '0.5';
                    },

                    dragEnter(e) {
                        e.target.closest('.draggable-item')?.classList.add('border-blue-400', 'border-2');
                    },

                    dragLeave(e) {
                        e.target.closest('.draggable-item')?.classList.remove('border-blue-400', 'border-2');
                    },

                    drop(e) {
                        e.preventDefault();
                        const dropTarget = e.target.closest('.draggable-item');

                        if (dropTarget && dropTarget !== this.draggedElement) {
                            const container = this.$refs.sortableContainer;
                            const allItems = Array.from(container.children);
                            const draggedIndex = allItems.indexOf(this.draggedElement);
                            const targetIndex = allItems.indexOf(dropTarget);

                            if (draggedIndex < targetIndex) {
                                dropTarget.parentNode.insertBefore(this.draggedElement, dropTarget.nextSibling);
                            } else {
                                dropTarget.parentNode.insertBefore(this.draggedElement, dropTarget);
                            }

                            this.updatePriorityBadges();
                            this.orderChanged = true;
                        }

                        dropTarget?.classList.remove('border-blue-400', 'border-2');
                    },

                    dragEnd(e) {
                        e.target.style.opacity = '1';
                        e.target.closest('.draggable-item')?.classList.remove('border-blue-400', 'border-2');
                    },

                    updatePriorityBadges() {
                        const items = this.$refs.sortableContainer.children;
                        Array.from(items).forEach((item, index) => {
                            const badge = item.querySelector('.bg-blue-500');
                            if (badge) {
                                badge.textContent = index + 1;
                            }
                        });
                    },

                    saveOrder() {
                        const items = this.$refs.sortableContainer.children;
                        const newOrder = Array.from(items).map(item => item.dataset.hash);

                        // Send AJAX request to update order
                        fetch('/admin/items/{{ $recordId }}/update-image-order', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                order: newOrder
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.orderChanged = false;
                                alert('Image order updated successfully!');
                            }
                        })
                        .catch(error => {
                            console.error('Error updating image order:', error);
                        });
                    }
                }
            }

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

            function deleteImage(hash) {
                const hashShort = hash.substring(0, 8) + '...';
                if (confirm(`Are you sure you want to delete this image?\n\nHash: ${hashShort}\n\nThis action cannot be undone.`)) {
                    // Show loading state
                    const deleteButton = event.target.closest('button');
                    const originalHTML = deleteButton.innerHTML;
                    deleteButton.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" class="opacity-75"></path></svg>';
                    deleteButton.disabled = true;
                    
                    fetch('/admin/items/{{ $recordId }}/delete-image', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            hash: hash
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Animate removal before reload
                            const imageElement = deleteButton.closest('.draggable-item');
                            imageElement.style.transition = 'all 0.3s ease';
                            imageElement.style.opacity = '0';
                            imageElement.style.transform = 'scale(0.8)';
                            
                            setTimeout(() => {
                                location.reload(); // Refresh to show updated images
                            }, 300);
                        } else {
                            alert('Error deleting image: ' + (data.message || 'Unknown error'));
                            deleteButton.innerHTML = originalHTML;
                            deleteButton.disabled = false;
                        }
                    })
                    .catch(error => {
                        console.error('Error deleting image:', error);
                        alert('Network error while deleting image. Please try again.');
                        deleteButton.innerHTML = originalHTML;
                        deleteButton.disabled = false;
                    });
                }
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
