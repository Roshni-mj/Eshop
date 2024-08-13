<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\ProductController;
use App\Http\Controllers\Panel\PanelController;
use App\Http\Middleware\CheckIfAdmin;
// Resource routes for products

Route::get('panel', [PanelController::class, 'index'])->name('panel');
Route::resource('products', ProductController::class);

// Add a test route


