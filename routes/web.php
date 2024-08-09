<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\CartController;

use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'welcome'])->name('welcome');


//  Route::get('products', [ProductController::class, 'index'])->name('products.index');

// Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
//  Route::post('products', [ProductController::class, 'store'])->name('products.store');

// Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
// Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
// // Route::get('products', [ProductController::class, 'store'])->name('products.store');
// route::match(['put','patch'],'products/{product}',[ProductController::class, 'update'])->name('products.update');
// Route::delete('products/{product}', [ProductController::class, 'delete'])->name('products.delete');
 Route::resource('products', ProductController::class);
 Route::resource('carts', CartController::class)->only(['index']);
 Route::resource('products.carts', ProductCartController::class)->only(['store','destroy']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
