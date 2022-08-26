<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClothingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewinController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShoesController;
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

//Route::get('/welcome', function () {
//    return view('welcome');
//});
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');



Route::get('/',[HomeController::class,'index'])
    ->name('home');


Route::get('/category',[CategoryController::class,'index'])
    ->name('category');
Route::get('/category/create', [CategoryController::class,'create'])
    ->name('category.create');

Route::post('/category/create',[CategoryController::class,'store'])
    ->name('category.store');

Route::get('/categories/{category}',[CategoryController::class,'show'])
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


Route::get('/new-in',[NewinController::class,'newProducts'])
    ->name('newin');
Route::get('/new-in-Clothing',[NewinController::class,'newCloths'])
    ->name('newCloths');
Route::get('new-in-Accessories',[NewinController::class,'newAccessories'])
    ->name('newAccessories');
Route::get('new-in-Shoes',[NewinController::class,'newShoes'])
    ->name('newShoes');


Route::get('/joggers',[ClothingController::class,'showAllJoggers'])
    ->name('joggers');
Route::get('/shirts',[ClothingController::class,'showAllShirts'])
    ->name('shirts');
Route::get('/shorts',[ClothingController::class,'showAllShorts'])
    ->name('shorts');
Route::get('/tshirts',[ClothingController::class,'showAllTshirts'])
    ->name('tshirts');
Route::get('/trainers',[ShoesController::class,'showAllTrainers'])
    ->name('trainers');
Route::get('/boots',[ShoesController::class,'showAllBoots'])
    ->name('boots');
Route::get('/shoes',[ShoesController::class,'showAllShoes'])
    ->name('shoes');

Route::get('/search',[SearchController::class,'search'])
    ->name('search');

Route::get('/show/{product}',[ProductController::class,'show'])
    ->name('show');

//Route::post('/{product}/add-to-cart',[CartController::class,'store'])
//    ->name('cart.store');
//
//Route::post('add-to-cart/{product}',[CartController::class,'addToCart'])
//    ->name('cart.add');


Route::get('/cart',[CartController::class,'getItemsFromCart'])
    ->name('cart.show');

Route::get('/checkout',[CheckoutController::class,'index'])
    ->name('checkout');


Route::post('/api/add-to-cart',[\App\Http\Controllers\Api\CartController::class,'addToCart'])
    ->name('api.add-to-cart')->middleware('auth');

Route::get('api/cart-items-count',[\App\Http\Controllers\Api\CartController::class,'getCartItemsCount'])
    ->name('api.cart-items-count');

Route::delete('api/delete-cart-item/{cartItem}',[\App\Http\Controllers\Api\CartController::class,'deleteCartItem']);

Route::get('api/cart-items',[\App\Http\Controllers\Api\CartController::class,'index']);

require __DIR__.'/auth.php';

