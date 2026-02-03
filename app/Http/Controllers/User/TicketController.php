<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Category;
use App\Rules\RecaptchaValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /**
     * Show the form for creating a new ticket.
     */
    public function create()
    {
        // PERBAIKAN: Gunakan orderBy('category_name') bukan 'name'
        $categories = Category::orderBy('category_name', 'asc')->get();

        return view('user.tickets.create', compact('categories'));
    }

    /**
     * Store a newly created ticket in storage.
     */
    public function store(Request $request)
    {
        // Validasi input - SESUAIKAN DENGAN STRUKTUR DATABASE
        $validated = $request->validate([
            'client_name' => 'required|string|max:255', // PERBAIKAN: client_name bukan full_name
            'client_email' => 'required|email|max:255', // PERBAIKAN: client_email bukan email
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id', // PERBAIKAN: nullable bukan required
            'description' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120', // 5MB
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

        // Generate unique ticket code - SESUAIKAN DENGAN FIELD DATABASE
        $ticketCode = 'TKT' . rand(10000, 99999);

        // Pastikan kode unik
        while (Ticket::where('ticket_code', $ticketCode)->exists()) {
            $ticketCode = 'TKT' . rand(10000, 99999);
        }

        // Handle file upload
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        // Create ticket - SESUAIKAN DENGAN STRUKTUR DATABASE
        $ticket = Ticket::create([
            'ticket_code' => $ticketCode, // PERBAIKAN: ticket_code bukan ticket_number
            'client_name' => $validated['client_name'],
            'client_email' => $validated['client_email'],
            'title' => $validated['title'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
            'attachment' => $attachmentPath,
            'status' => 'open', // Status awal
            'priority' => 'medium', // Priority default
        ]);

        // TODO: Kirim email notifikasi ke user
        // Mail::to($ticket->client_email)->send(new TicketCreated($ticket));

        // Redirect dengan success message
        return redirect()
            ->route('user.tickets.success', ['ticket_code' => $ticketCode]) // PERBAIKAN: ticket_code bukan ticket_number
            ->with('success', 'Tiket berhasil dibuat! Nomor tiket Anda: ' . $ticketCode);
    }

    /**
     * Show ticket success page.
     */
    public function success($ticketCode) // PERBAIKAN: Parameter ticket_code bukan ticket_number
    {
        $ticket = Ticket::where('ticket_code', $ticketCode)->firstOrFail();

        return view('user.tickets.success', compact('ticket'));
    }
}
