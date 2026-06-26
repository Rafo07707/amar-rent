<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExtraController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('cars', CarController::class)->except(['show']);
        Route::resource('locations', LocationController::class)->except(['show']);
        Route::resource('extras', ExtraController::class)->except(['show']);

        Route::resource('bookings', BookingController::class)->only(['index', 'show', 'destroy']);
        Route::put('bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');

        Route::resource('inquiries', InquiryController::class)->only(['index', 'show', 'destroy']);
        Route::put('inquiries/{inquiry}', [InquiryController::class, 'update'])->name('inquiries.update');

        Route::resource('pages', PageController::class)->only(['index', 'edit', 'update']);
        Route::resource('faqs', FaqController::class)->except(['show']);

        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
