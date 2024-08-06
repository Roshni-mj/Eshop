<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('products', [ProductController::class, 'index'])->name('products.index');

Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');

Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Route::get('products', [ProductController::class, 'store'])->name('products.store');
route::match(['put','patch'],'products/{product}',[ProductController::class, 'update'])->name('products.update');
Route::delete('products/{product}', [ProductController::class, 'delete'])->name('products.delete');
// route::get('products',function(){
//     return 'This is the list of products';

// })->name('products.index');
// route::get('products','ProductController@index')->name('products.index');

// route::get('products/create',function(){
//     return 'A form to create products';

// })->name('products.create');

// route::post('products',function(){

// })->name('products.store');

// route::get('products/{product}',function ($product){
//     return "Showing products of {$product} ";

// })->name('product.show');




// route::get('products/{product}/edit',function ($product){
//     return "Showing the form to edit the products of {$product} ";

// })->name('product.edit');

// route::match(['put','patch'],'products/{product}',function ($product){
// })->name('product.update');

// route::delete('products/{product}',function ($product){
// })->name('product.destroy');