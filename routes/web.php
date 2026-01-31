<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\TicketController;

// Add this route
Route::get('/home', [HomeController::class, 'index'])->name('user.home');

Route::prefix('tickets')->name('user.tickets.')->group(function () {
    Route::get('/create', [TicketController::class, 'create'])->name('create');
    Route::post('/store', [TicketController::class, 'store'])->name('store');
    Route::get('/success/{ticket_number}', [TicketController::class, 'success'])->name('success');
    Route::get('/track', [TicketController::class, 'track'])->name('track');
});

Route::get('/test-captcha', function () {
    return view('test-captcha');
});
