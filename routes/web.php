<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/add-new-user', [UsersController::class, 'create'])->name('user.create');
    Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

    Route::prefix('product-groups')->group(function () {
        Route::get('/', [ProductsController::class, 'product_group'])->name('product.group');
        Route::get('/create', [ProductsController::class, 'add_product_group'])->name('add.product.group');
        Route::post('/store', [ProductsController::class, 'product_group_store'])->name('product-group.store');
        Route::get('/{id}/edit', [ProductsController::class, 'edit_product_group'])->name('product-group.edit');
        Route::put('/{id}/update', [ProductsController::class, 'update_product_group'])->name('product-group.update');
        Route::delete('/{id}/delete', [ProductsController::class, 'destroy_product_group'])->name('product-group.destroy');
    });
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductsController::class, 'index'])->name('product');
        Route::get('/create', [ProductsController::class, 'add_product'])->name('add.product');
        Route::post('/store', [ProductsController::class, 'product_store'])->name('product.store');
        Route::get('/product/{id}/edit', [ProductsController::class, 'edit_product'])->name('product.edit');
        Route::put('/product/{id}', [ProductsController::class, 'product_update'])->name('product.update');
        Route::delete('/product/{id}', [ProductsController::class, 'product_destroy'])->name('product.destroy');
    });

    Route::prefix('services')->group(function () {
        Route::get('/', [ProductsController::class, 'services'])->name('services');
        Route::get('/create', [ProductsController::class, 'add_services'])->name('add.services');
        Route::post('/store', [ProductsController::class, 'product_group_store'])->name('services.store');
        Route::get('/{id}/edit', [ProductsController::class, 'edit_product_group'])->name('product-group.edit');
        Route::put('/{id}/update', [ProductsController::class, 'update_product_group'])->name('product-group.update');
        Route::delete('/{id}/delete', [ProductsController::class, 'destroy_product_group'])->name('product-group.destroy');
    });
});

require __DIR__ . '/auth.php';
