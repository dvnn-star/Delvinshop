<?php

use App\Http\Controllers\Payment\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('order', [OrderController::class, 'store'])->name('order.store');
    Route::get('order/{order:invoice_number}', [OrderController::class, 'index'])->name('order');

});
