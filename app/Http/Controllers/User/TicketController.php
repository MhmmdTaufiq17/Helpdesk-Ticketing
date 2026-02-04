<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Category;
use App\Rules\RecaptchaValidation;
use Illuminate\Http\Request;
use App\Mail\TicketCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    /**
     * Show the form for creating a new ticket.
     */
    public function create()
    {
        $categories = Category::orderBy('category_name', 'asc')->get();

        return view('user.tickets.create', compact('categories'));
    }

    /**
     * Store a newly created ticket in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
            'g-recaptcha-response' => ['required', new RecaptchaValidation()],
        ], [
            'client_name.required' => 'Nama lengkap wajib diisi.',
            'client_email.required' => 'Email wajib diisi.',
            'client_email.email' => 'Format email tidak valid.',
            'title.required' => 'Judul laporan wajib diisi.',
            'category_id.exists' => 'Kategori tidak valid.',
            'description.required' => 'Deskripsi wajib diisi.',
            'attachment.mimes' => 'Format file tidak didukung. Gunakan: JPG, PNG, PDF, DOC, DOCX.',
            'attachment.max' => 'Ukuran file maksimal 5MB.',
            'g-recaptcha-response.required' => 'Verifikasi reCAPTCHA wajib diisi.',
        ]);

        // Generate unique ticket code
        $ticketCode = 'TKT' . rand(10000, 99999);
        while (Ticket::where('ticket_code', $ticketCode)->exists()) {
            $ticketCode = 'TKT' . rand(10000, 99999);
        }

        // Handle file upload
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        // Create ticket
        $ticket = Ticket::create([
            'ticket_code' => $ticketCode,
            'client_name' => $validated['client_name'],
            'client_email' => $validated['client_email'],
            'title' => $validated['title'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
            'attachment' => $attachmentPath,
            'status' => 'open',
            'priority' => 'medium',
        ]);

        // Kirim email notifikasi ke user
        try {
            Mail::to($ticket->client_email)->send(new TicketCreated($ticket));

            // Optional: Kirim notifikasi ke admin
            $adminEmail = config('mail.admin_email');
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new \App\Mail\TicketCreatedAdmin($ticket));
            }

            Log::info('Email sent successfully for ticket: ' . $ticketCode);

        } catch (\Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage());
            // Lanjutkan tanpa throw error agar user tetap dapat tiketnya
        }

        return redirect()
            ->route('user.tickets.success', ['ticket_code' => $ticketCode])
            ->with('success', 'Tiket berhasil dibuat! Nomor tiket Anda: ' . $ticketCode);
    }

    /**
     * Show ticket success page.
     */
    public function success($ticketCode)
    {
        $ticket = Ticket::where('ticket_code', $ticketCode)->firstOrFail();

        return view('user.tickets.success', compact('ticket'));
    }
}
