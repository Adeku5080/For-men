<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FavouriteController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Middleware\Auth;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfNotLoggedIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories/{category}/subcategories', [CategoryController::class, 'subCategories'])
    ->name('api.category.sub-categories');

Route::get('/products',[ProductApiController::class,'index']);
Route::get('/products/{product}',[ProductApiController::class,'show']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}',[CategoryController::class,'show']);

Route::get('/sub-categories',[SubCategoryController::class,'index']);
Route::get('/sub-categories/{subCategory}',[SubCategoryController::class,'show']);
Route::get('/sub-categories/{subCategory}/products', [SubCategoryController::class, 'products']);

Route::post('/add-to-favourites',[FavouriteController::class,'create']);
Route::delete('/removeFav/{product}',[FavouriteController::class,'removeFav']);
