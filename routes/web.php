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

// about
Route::get('/about', [App\Http\Controllers\FrontendController::class, 'about'])->name('about');

// cart
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{productId}/{quantity}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/update/{cartId}', [App\Http\Controllers\CartController::class, 'updateCart'])->name('cart.update');

    Route::get('/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');

    Route::post('/checkout/process', [App\Http\Controllers\CartController::class, 'checkoutProcess'])->name('checkout.process');

    // success
    Route::get('/checkout/success/{id}', [App\Http\Controllers\CartController::class, 'checkoutSuccess'])->name('checkout.success');
});

// route cities
Route::get('/cities/{province_id}', [App\Http\Controllers\CartController::class, 'getCities'])->name('cities');
// checkongkir
Route::post('/checkongkir', [App\Http\Controllers\CartController::class, 'check_ongkir'])->name('checkOngkir');
