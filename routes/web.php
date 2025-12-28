<?php

use App\Http\Controllers\Filter\FilterController;
use App\Http\Controllers\payment\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductShowController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [ProductShowController::class, 'index'])->name('home');
Route::post('/', [ProductShowController::class, 'store'])->name('forms.store');
Route::get('/q/{q}', [ProductShowController::class, 'search'])->name('search');
Route::get('/f/baju',[FilterController::class,'Baju'])->name('filter.baju');
Route::get('/f/celana',[FilterController::class,'Celana'])->name('filter.celana');
Route::get('/f/gaun',[FilterController::class,'Gaun'])->name('filter.gaun');
Route::get('/f/kemeja',[FilterController::class,'Kemeja'])->name('filter.kemeja');



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

Route::post('/payment/callback',[PaymentController::class ,'HandleCallBack'])->name('payment.callback');
require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/userSettings.php';
require __DIR__ . '/order.php';