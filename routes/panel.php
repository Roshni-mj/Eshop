<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\ProductController;
use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Middleware\CheckIfAdmin;
// Resource routes for products

Route::get('panel', [PanelController::class, 'index'])->name('panel');
Route::resource('products', ProductController::class);
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::post('users/admin/{user}', [UserController::class, 'toggleAdmin'])->name('users.admin.toggle');

// Add a test route


