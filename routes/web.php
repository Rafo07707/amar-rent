<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingPageController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

// Redirect root to default locale
Route::get('/', function () {
    return redirect('/' . config('app.locale'), 301);
});

// SEO files
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => 'hy|ru|en'],
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/fleet', [CarController::class, 'index'])->name('fleet');
    Route::get('/fleet/{car}', [CarController::class, 'show'])->name('car.show');

    Route::get('/locations', [LocationController::class, 'index'])->name('locations');
    Route::get('/locations/{location}', [LocationController::class, 'show'])->name('location.show');

    Route::get('/services', [PageController::class, 'services'])->name('services');
    Route::get('/about', [PageController::class, 'about'])->name('about');

    // Booking flow: car + dates + extras -> stored as a Booking, goes to admin Bookings
    Route::get('/booking', [BookingPageController::class, 'show'])->name('booking.show');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

    // Contact: plain inquiry form, no car/dates/extras
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    Route::get('/faq', [PageController::class, 'faq'])->name('faq');
    Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
    Route::get('/terms', [PageController::class, 'terms'])->name('terms');
});
