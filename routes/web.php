<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ImagesController;
use Illuminate\Support\Facades\Route;

Route::group([ 'middleware' => 'auth' ], function () {
    Route::get('/', [CatalogController::class, 'home'])->name('home');

    Route::get('/get_inventory_number/{category}', [CatalogController::class, 'getInventoryNumber'])
        ->where(['category' => '[0-9]+']);

    Route::get('/catalogData/{category?}', [CatalogController::class, 'getCatalogData'])
        ->where(['category' => '[0-9]+']);

    Route::pattern('catalog', '[0-9]+');
    Route::resource('/catalog', CatalogController::class);

    Route::resource('/category', CategoryController::class);
    Route::resource('/language', LanguageController::class);

    Route::get('/logout', [CatalogController::class, 'logout']);

    Route::get('/images/{category}', [ImagesController::class, 'getImages'])
        ->where(['category' => '[0-9]+']);
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);
