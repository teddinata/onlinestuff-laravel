<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GalleryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('dashboard')->group(function () {
        // name: dashboard


        Route::middleware(['admin'])->group(function (){
            Route::name('dashboard')->group(function () {
                // get: dashboard
                Route::get('/', function () {
                    return view('dashboard');
                });
            });
            // prefix: product-categories
            Route::resource('category', CategoryController::class);
            // // prefix: products
            Route::resource('product', ProductController::class);
            Route::resource('gallery', GalleryController::class);
            // // user
            // Route::resource('user', UserController::class);
            // Route::resource('size', SizeController::class);
            // Route::resource('product_size', ProductSizeController::class);
            // Route::resource('transactions', TransactionController::class);


        });
    });
});

// home
Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('home');
Route::get('/product/{slug}', [App\Http\Controllers\FrontendController::class, 'product'])->name('product');
// shop page
Route::get('/shop/{category?}', [App\Http\Controllers\FrontendController::class, 'shop'])->name('shop');
// detail
Route::get('/product/{slug}', [App\Http\Controllers\FrontendController::class, 'productDetail'])->name('product.detail');
