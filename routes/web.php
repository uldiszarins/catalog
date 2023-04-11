<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [CatalogController::class, 'home'])->name('home');

Route::get('/get_inventory_number/{category}', [CatalogController::class, 'getInventoryNumber'])
    ->where(['category' => '[0-9]+']);

Route::get('/catalogData', [CatalogController::class, 'getCatalogData']);

Route::resource('/catalog', CatalogController::class);

Route::resource('/category', CategoryController::class);
Route::resource('/language', LanguageController::class);
