<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductShowController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [ProductShowController::class, 'index'])->name('home');
Route::post('/', [ProductShowController::class, 'store'])->name('forms.store');
Route::get('/q/{q}', [ProductShowController::class, 'search'])->name('search');


Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified', 'role:staff'])->name('dashboard');

Route::middleware(['auth', 'verified', 'role:staff'])->group(function () {

    Route::get('Products', [ProductController::class, 'index'])->name('products');
    Route::get('Products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('Products', [ProductController::class, 'store'])->name('products.store');
    Route::get('Products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('Products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('Products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('Products/{q}', [ProductController::class, 'search'])->name('search.query');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
