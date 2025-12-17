<?php

use App\Http\Controllers\UserSettingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
Route::middleware('auth')->group(function(){

    Route::get('user/settings',[UserSettingController::class,'index'])->name('user.settings');
    Route::put('user/settings',[UserSettingController::class,'update'])->name('user.update');
    
});


