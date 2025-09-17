<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berit Admin - Custom Styles Demo</title>
    @vite('resources/css/filament/admin/theme.css')
</head>
<body class="h-full">
    <div class="container mx-auto px-4 py-8 berit-scrollbar">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Berit Admin - Custom CSS Classes Demo</h1>
        
        <!-- Cards Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Cards</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="berit-card">
                    <div class="berit-card-header">
                        <h3 class="berit-form-section-title">Basic Card</h3>
                    </div>
                    <div class="berit-card-body">
                        <p class="text-gray-600">This is a basic card with header and body using Berit Admin styles.</p>
                    </div>
                </div>
                
                <div class="berit-widget">
                    <div class="berit-widget-header">
                        <h3 class="berit-widget-title">Widget Card</h3>
                    </div>
                    <div class="berit-widget-value">1,234</div>
                    <div class="berit-widget-description">Total users registered</div>
                </div>
                
                <div class="berit-chart-container">
                    <h3 class="berit-widget-title">Chart Container</h3>
                    <p class="berit-help-text">Perfect for charts and graphs</p>
                </div>
            </div>
        </section>
        
        <!-- Buttons Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Buttons</h2>
            <div class="flex flex-wrap gap-4">
                <button class="berit-button-primary">Primary Button</button>
                <button class="berit-button-secondary">Secondary Button</button>
                <button class="berit-button-danger">Danger Button</button>
            </div>
        </section>
        
        <!-- Badges Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Badges</h2>
            <div class="flex flex-wrap gap-4">
                <span class="berit-badge-success">Success</span>
                <span class="berit-badge-warning">Warning</span>
                <span class="berit-badge-danger">Danger</span>
                <span class="berit-badge-info">Info</span>
            </div>
        </section>
        
        <!-- Stat Cards Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Gradient Stat Cards</h2>
            <div class="berit-dashboard-grid">
                <div class="berit-stat-card-primary">
                    <h3 class="text-lg font-semibold mb-2">Primary Stat</h3>
                    <p class="text-3xl font-bold">$12,345</p>
                    <p class="text-blue-100">Total Revenue</p>
                </div>
                
                <div class="berit-stat-card-success">
                    <h3 class="text-lg font-semibold mb-2">Success Stat</h3>
                    <p class="text-3xl font-bold">98.5%</p>
                    <p class="text-green-100">Uptime</p>
                </div>
                
                <div class="berit-stat-card-warning">
                    <h3 class="text-lg font-semibold mb-2">Warning Stat</h3>
                    <p class="text-3xl font-bold">23</p>
                    <p class="text-yellow-100">Pending Items</p>
                </div>
                
                <div class="berit-stat-card-danger">
                    <h3 class="text-lg font-semibold mb-2">Danger Stat</h3>
                    <p class="text-3xl font-bold">5</p>
                    <p class="text-red-100">Critical Alerts</p>
                </div>
            </div>
        </section>
        
        <!-- Image Gallery Demo Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Image Gallery Components</h2>
            <div class="berit-image-gallery">
                <div class="berit-image-item">
                    <div class="berit-priority-badge">1</div>
                    <button class="berit-delete-button">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <div class="berit-drag-handle">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                        </svg>
                    </div>
                    <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white">
                        Image 1
                    </div>
                    <div class="berit-image-overlay">
                        <div class="berit-image-actions">
                            <button class="bg-white text-gray-800 px-3 py-1 rounded">View</button>
                        </div>
                    </div>
                </div>
                
                <div class="berit-image-item">
                    <div class="berit-priority-badge">2</div>
                    <button class="berit-delete-button">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <div class="w-full h-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white">
                        Image 2
                    </div>
                    <div class="berit-image-overlay">
                        <div class="berit-image-actions">
                            <button class="bg-white text-gray-800 px-3 py-1 rounded">View</button>
                        </div>
                    </div>
                </div>
                
                <div class="berit-image-item">
                    <div class="berit-priority-badge">3</div>
                    <button class="berit-delete-button">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <div class="w-full h-full bg-gradient-to-br from-pink-400 to-red-500 flex items-center justify-center text-white">
                        Image 3
                    </div>
                    <div class="berit-image-overlay">
                        <div class="berit-image-actions">
                            <button class="bg-white text-gray-800 px-3 py-1 rounded">View</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Animation Examples -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Animations</h2>
            <div class="flex flex-wrap gap-4">
                <div class="berit-card berit-fade-in p-4">
                    <p>Fade In Animation</p>
                </div>
                <div class="berit-card berit-slide-up p-4">
                    <p>Slide Up Animation</p>
                </div>
                <div class="berit-card berit-bounce-in p-4">
                    <p>Bounce In Animation</p>
                </div>
            </div>
        </section>
        
        <!-- Form Section Example -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Form Sections</h2>
            <div class="berit-form-section">
                <div class="berit-form-section-header">
                    <h3 class="berit-form-section-title">User Information</h3>
                    <span class="berit-badge-info">Required</span>
                </div>
                <div class="berit-form-section-body">
                    <p>This is a form section with header and body content.</p>
                    <p class="berit-help-text">Use this style for organizing form fields into logical groups.</p>
                </div>
            </div>
        </section>
    </div>
</body>
</html>