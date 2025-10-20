<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Resources\Items\Pages\EditItem;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-images', function () {
    return view('test-images');
});

Route::get('/berit-styles', function () {
    return view('berit-styles-demo');
});

// Image management routes for Filament Items
Route::middleware(['web'])->prefix('admin/items')->name('filament.admin.resources.items.')->group(function () {
    Route::post('{record}/update-image-order', [EditItem::class, 'updateImageOrder'])->name('update-image-order');
    Route::delete('{record}/delete-image', [EditItem::class, 'deleteImage'])->name('delete-image');
});

// Media Library API routes
Route::middleware(['web', 'auth:admin'])->prefix('admin/api')->group(function () {
    Route::get('media-folders', function () {
        $folders = \App\Models\Folder::withCount(['files' => function ($query) {
            $query->where('is_image', true);
        }])
            ->having('files_count', '>', 0)
            ->get();
        
        return response()->json($folders);
    });
    
    Route::get('media-folders/{folder}/images', function ($folderId) {
        $files = \App\Models\File::where('folder_id', $folderId)
            ->where('is_image', true)
            ->get()
            ->mapWithKeys(fn ($file) => [
                $file->id => [
                    'id' => $file->id,
                    'title' => $file->title,
                    'url' => asset('storage/' . $file->path),
                    'path' => $file->path,
                ]
            ]);
        
        return response()->json($files);
    });
});
