<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[HomeController::class,'index'])
    ->name('home');


    Route::get('/category',[CategoryController::class,'index'])
        ->name('category');
    Route::get('/category/create', [CategoryController::class,'create'])
        ->name('category.create');

    Route::post('/',[CategoryController::class,'store'])
        ->name('category.store');

    Route::get('/{category}',[CategoryController::class,'show'])
        ->name('category.show');


Route::get('/subcategories',[SubcategoryController::class,'create'])
    ->name('subcategory.create');
Route::post('/subcategories/store',[SubcategoryController::class,'store'])
    ->name('subcategory.store');
Route::get('/products/create',[ProductController::class,'create'])
    ->name('product.create');
Route::get('/subcategories/{subCategory}',[SubcategoryController::class,'show'])
    ->name('subcategory.show');
Route::post('/products/store',[ProductController::class,'store'])
    ->name('product.store');
Route::get('/brands',[BrandController::class,'create'])
    ->name('brand.create');
Route::post('/brands',[BrandController::class,'store'])
    ->name('brand.store');



require __DIR__.'/auth.php';

