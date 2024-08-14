<?php
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderPaymentController;
use App\Http\Controllers\Panel\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIfAdmin;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::Put('profile', [ProfileController::class, 'update'])->name('profile.update');

Route::post('store', [OrderController::class, 'store'])->name('store');

//  Route::get('products', [ProductsController::class, 'index'])->name('products.index');

// Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
//  Route::post('products', [ProductController::class, 'store'])->name('products.store');

// Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
// Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
// // Route::get('products', [ProductController::class, 'store'])->name('products.store');
// route::match(['put','patch'],'products/{product}',[ProductController::class, 'update'])->name('products.update');

Route::delete('products/{product}', [ProductController::class, 'delete'])->name('products.delete');
//  Route::resource('products', ProductController::class);
Route::resource('carts', CartController::class)->only(['index']);
Route::resource('orders', OrderController::class)->only(['create', 'store'])->middleware(['verified']);


Route::resource('orders.payments', OrderPaymentController::class)->only(['create','store'])->middleware(['verified']);
Route::resource('products.carts', ProductCartController::class)->only(['store','destroy']);
Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['web', 'auth', 'isadmin','verified'])
    ->prefix('panel')
    ->namespace('App\Http\Controllers\Panel')
    ->group(function () {
        // Include additional route file
        require base_path('routes/panel.php');
    });
    