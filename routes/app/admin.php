<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\MataPelajaranController;

Route::group(['domain' => ''], function() {
    Route::redirect('admin', 'admin/dashboard', 301);
    Route::prefix('admin')->name('admin.')->group(function() {
        Route::redirect('/', 'dashboard', 301);
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('logout', [AuthController::class, 'do_logout'])->name('logout');
        Route::resource('room', RoomController::class);
        Route::resource('pelajaran', MataPelajaranController::class);
    });
});