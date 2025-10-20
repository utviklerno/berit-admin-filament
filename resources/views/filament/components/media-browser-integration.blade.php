<div 
    x-data="mediaBrowserGlobal()"
    x-init="init()"
    x-cloak
>
    <!-- Media Browser Modal -->
    <div 
        x-show="showModal"
        class="fixed inset-0 z-50 overflow-y-auto"
        style="display: none;"
    >
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div 
                x-show="showModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                @click="closeModal"
            ></div>

            <div
                x-show="showModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block w-full max-w-5xl overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle"
            >
                <div class="px-4 pt-5 pb-4 sm:p-6">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                                Select Image from Media Library
                            </h3>

                            <!-- Folder Selector -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Select Folder
                                </label>
                                <select
                                    x-model="selectedFolder"
                                    @change="loadImages"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300"
                                >
                                    <option value="">-- Choose a folder --</option>
                                    <template x-for="folder in folders" :key="folder.id">
                                        <option :value="folder.id" x-text="`${folder.title} (${folder.files_count} images)`"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- Images Grid -->
                            <div x-show="images.length > 0" class="mb-4">
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-h-96 overflow-y-auto p-2">
                                    <template x-for="image in images" :key="image.id">
                                        <div
                                            @click="insertImage(image)"
                                            class="relative cursor-pointer group rounded-lg overflow-hidden border-2 border-gray-300 hover:border-primary-500 transition-all dark:border-gray-600"
                                        >
                                            <div class="aspect-square">
                                                <img 
                                                    :src="image.url"
                                                    :alt="image.title"
                                                    class="w-full h-full object-cover"
                                                >
                                            </div>
                                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all flex items-center justify-center">
                                                <svg class="w-10 h-10 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-xs p-2 truncate">
                                                <span x-text="image.title"></span>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <div x-show="selectedFolder && images.length === 0" class="text-center py-8 text-gray-500 dark:text-gray-400">
                                No images in this folder
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 dark:bg-gray-900 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                    <button
                        type="button"
                        @click="closeModal"
                        class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 sm:w-auto dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function mediaBrowserGlobal() {
        return {
            showModal: false,
            folders: [],
            selectedFolder: '',
            images: [],
            currentEditor: null,

            init() {
                this.loadFolders();
                this.addButtonsToEditors();
                
                // Re-add buttons after Livewire updates
                document.addEventListener('livewire:navigated', () => {
                    setTimeout(() => this.addButtonsToEditors(), 1000);
                });
            },

            async loadFolders() {
                try {
                    const response = await fetch('/admin/api/media-folders');
                    this.folders = await response.json();
                } catch (error) {
                    console.error('Error loading folders:', error);
                }
            },

            async loadImages() {
                if (!this.selectedFolder) {
                    this.images = [];
                    return;
                }

                try {
                    const response = await fetch(`/admin/api/media-folders/${this.selectedFolder}/images`);
                    const data = await response.json();
                    this.images = Object.values(data);
                } catch (error) {
                    console.error('Error loading images:', error);
                }
            },

            addButtonsToEditors() {
                const editors = document.querySelectorAll('[data-has-media-browser="true"]');
                
                editors.forEach(editorWrapper => {
                    if (editorWrapper.querySelector('.media-browse-btn')) return;
                    
                    const fieldWrapper = editorWrapper.closest('[data-field-wrapper-id]');
                    if (!fieldWrapper) return;
                    
                    const label = fieldWrapper.querySelector('label');
                    if (!label) return;
                    
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.className = 'media-browse-btn ml-2 inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-primary-600 hover:text-primary-700 dark:text-primary-400';
                    button.innerHTML = `
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Browse Media</span>
                    `;
                    
                    button.addEventListener('click', () => {
                        this.openModal(fieldWrapper);
                    });
                    
                    label.appendChild(button);
                });
            },

            openModal(fieldWrapper) {
                const livewireElement = fieldWrapper.querySelector('[wire\\:id]');
                if (!livewireElement) return;
                
                const componentId = livewireElement.getAttribute('wire:id');
                const livewireComponent = Livewire.find(componentId);
                
                if (livewireComponent && livewireComponent.editor) {
                    this.currentEditor = livewireComponent.editor;
                    this.showModal = true;
                }
            },

            closeModal() {
                this.showModal = false;
                this.selectedFolder = '';
                this.images = [];
            },

            insertImage(image) {
                if (this.currentEditor && this.currentEditor.chain) {
                    this.currentEditor.chain().focus().setImage({ 
                        src: image.url, 
                        alt: image.title 
                    }).run();
                    this.closeModal();
                }
            }
        }
    }
</script>
