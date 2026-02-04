<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\TicketController;
use App\Http\Controllers\User\TicketTrackController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route untuk root path - langsung ke home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public Home Page
Route::get('/home', [HomeController::class, 'index'])->name('user.home');

// Public Ticket Routes (Tidak perlu login)
Route::prefix('tickets')->name('user.tickets.')->group(function () {
    // Create ticket tanpa login
    Route::get('/create', [TicketController::class, 'create'])->name('create');
    Route::post('/store', [TicketController::class, 'store'])->name('store');

    // Success page setelah create
    Route::get('/success/{ticket_code}', [TicketController::class, 'success'])->name('success');

    // Track ticket tanpa login
    Route::get('/track', [TicketTrackController::class, 'showTrackForm'])->name('track.form');
    Route::post('/track', [TicketTrackController::class, 'track'])->name('track');
    Route::get('/track/{ticket_code}', [TicketTrackController::class, 'showTrackResult'])->name('track.result');

    // View ticket details tanpa login (dengan code)
    Route::get('/view/{ticket_code}', [TicketTrackController::class, 'showPublic'])->name('show');
});

// Static Pages (Optional)
Route::prefix('pages')->name('pages.')->group(function () {
    Route::get('/about', function () {
        return view('pages.about');
    })->name('about');

    Route::get('/contact', function () {
        return view('pages.contact');
    })->name('contact');

    Route::get('/faq', function () {
        return view('pages.faq');
    })->name('faq');

    Route::get('/privacy', function () {
        return view('pages.privacy');
    })->name('privacy');
});

// Fallback Route untuk 404
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
