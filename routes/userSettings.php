<?php

use App\Http\Controllers\UserSettingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
Route::middleware('auth')->group(function(){

    Route::get('user/settings',[UserSettingController::class,'index'])->name('user.settings');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
