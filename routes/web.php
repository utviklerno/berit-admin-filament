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
