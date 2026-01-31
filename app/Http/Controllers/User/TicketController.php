<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Category;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /**
     * Show the form for creating a new ticket.
     */
    public function create()
    {
        // HAPUS where('is_active', true) -> gunakan all() saja
        $categories = Category::all(); // atau Category::orderBy('name')->get()

        return view('user.tickets.create', compact('categories'));
    }

    /**
     * Store a newly created ticket in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120', // 5MB
            'g-recaptcha-response' => ['required', new Recaptcha()],
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'title.required' => 'Judul laporan wajib diisi.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
            'description.required' => 'Deskripsi wajib diisi.',
            'attachment.mimes' => 'Format file tidak didukung. Gunakan: JPG, PNG, PDF, DOC, DOCX.',
            'attachment.max' => 'Ukuran file maksimal 5MB.',
            'g-recaptcha-response.required' => 'Verifikasi reCAPTCHA wajib diisi.',
        ]);

        // Generate unique ticket number
        $ticketNumber = 'TKT-' . strtoupper(Str::random(8));

        // Handle file upload
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        // Create ticket
        $ticket = Ticket::create([
            'ticket_number' => $ticketNumber,
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'title' => $validated['title'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
            'attachment' => $attachmentPath,
            'status' => 'open', // Status awal
            'priority' => 'medium', // Priority default
        ]);

        // TODO: Kirim email notifikasi ke user
        // Mail::to($ticket->email)->send(new TicketCreated($ticket));

        // Redirect dengan success message
        return redirect()
            ->route('user.tickets.success', ['ticket_number' => $ticketNumber])
            ->with('success', 'Tiket berhasil dibuat! Nomor tiket Anda: ' . $ticketNumber);
    }

    /**
     * Show ticket success page.
     */
    public function success($ticketNumber)
    {
        $ticket = Ticket::where('ticket_number', $ticketNumber)->firstOrFail();

        return view('user.tickets.success', compact('ticket'));
    }
}
