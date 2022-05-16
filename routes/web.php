<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('', function () {
    return view('page.welcome');
});
Route::get('auth',[AuthController::class, 'index'])->name('auth.index');

    Route::prefix('auth')->name('auth.')->group(function(){
        Route::post('login',[AuthController::class, 'do_login'])->name('login');
        Route::post('register',[AuthController::class, 'do_register'])->name('register');
        Route::post('forgot',[AuthController::class, 'do_forgot'])->name('forgot');
        Route::post('reset',[AuthController::class, 'do_reset'])->name('reset');
    });
