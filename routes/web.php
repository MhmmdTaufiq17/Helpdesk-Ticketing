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
// PERBAIKAN: Ubah dari 'tickets.' menjadi 'user.tickets.'
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

// Static Pages (Optional) - Tetap 'pages.'
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

// Email Preview Route (Hanya untuk development)
if (app()->environment('local')) {
    Route::get('/email-preview/ticket-created', function () {
        $ticket = \App\Models\Ticket::first();

        if (!$ticket) {
            // Create dummy ticket for preview
            $ticket = new \App\Models\Ticket([
                'ticket_code' => 'TKT' . rand(10000, 99999),
                'client_name' => 'John Doe',
                'client_email' => 'john@example.com',
                'title' => 'Test Ticket Title',
                'description' => 'This is a test description for the ticket preview. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'status' => 'open',
                'priority' => 'medium',
                'created_at' => now(),
            ]);

            // Add category relationship if needed
            $ticket->setRelation('category', new \App\Models\Category([
                'category_name' => 'Technical Support'
            ]));
        }

        return new \App\Mail\TicketCreated($ticket);
    })->name('email.preview.ticket');
}

// Fallback Route untuk 404
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
