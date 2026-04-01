<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\TicketController;
use App\Http\Controllers\User\TicketTrackController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ──────────────────────────────────────────────
//  PUBLIC — User Routes
// ──────────────────────────────────────────────

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('user.home');

Route::prefix('tickets')->name('user.tickets.')->group(function () {
    Route::get('/create',                [TicketController::class, 'create'])->name('create');
    Route::post('/store',                [TicketController::class, 'store'])->name('store');
    Route::get('/success/{ticket_code}', [TicketController::class, 'success'])->name('success');
    Route::get('/track',               [TicketTrackController::class, 'showTrackForm'])->name('track.form');
    Route::post('/track',              [TicketTrackController::class, 'track'])->name('track');
    Route::post('/track/search',       [TicketTrackController::class, 'trackAjax'])->name('track.do');
    Route::get('/track/{ticket_code}', [TicketTrackController::class, 'showTrackResult'])->name('track.result');
    Route::get('/view/{ticket_code}',  [TicketTrackController::class, 'showTrackResult'])->name('show');
});

Route::prefix('pages')->name('pages.')->group(function () {
    Route::get('/about',   fn() => view('pages.about'))->name('about');
    Route::get('/contact', fn() => view('pages.contact'))->name('contact');
    Route::get('/faq',     fn() => view('pages.faq'))->name('faq');
    Route::get('/privacy', fn() => view('pages.privacy'))->name('privacy');
});

// ──────────────────────────────────────────────
//  ADMIN Routes
// ──────────────────────────────────────────────

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest only
    Route::middleware('guest')->group(function () {
        Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    // Auth + Admin role
    Route::middleware(['auth', 'admin'])->group(function () {

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', fn() => redirect()->route('admin.dashboard'));
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Tiket
        Route::prefix('tickets')->name('tickets.')->group(function () {
            Route::get('/',              [AdminTicketController::class, 'index'])->name('index');
            Route::get('/search',        [AdminTicketController::class, 'search'])->name('search');
            Route::get('/{id}',          [AdminTicketController::class, 'show'])->name('show');
            Route::patch('/{id}/status', [AdminTicketController::class, 'updateStatus'])->name('update-status');
            Route::post('/{id}/reply',   [AdminTicketController::class, 'reply'])->name('reply');
            Route::delete('/{id}',       [AdminTicketController::class, 'destroy'])->name('destroy');
        });

        // Laporan
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/',       [ReportController::class, 'index'])->name('index');
            Route::get('/export', [ReportController::class, 'export'])->name('export');
        });

        // Profil Admin
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
            Route::patch('/',   [ProfileController::class, 'update'])->name('update');
        });

        // Pengaturan
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/',  [SettingController::class, 'index'])->name('index');
            Route::post('/', [SettingController::class, 'update'])->name('update');
        });
    });
});

// ──────────────────────────────────────────────
//  404 Fallback
// ──────────────────────────────────────────────
Route::fallback(fn() => response()->view('errors.404', [], 404));
