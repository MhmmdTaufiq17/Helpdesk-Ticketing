<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Category;
use App\Rules\RecaptchaValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;          // [FIX #2] import Str
use App\Mail\TicketCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    public function create()
    {
        $categories = Category::orderBy('category_name', 'asc')->get();

        return view('user.tickets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name'          => 'required|string|max:255',
            'client_email'         => 'required|email|max:255',
            'title'                => 'required|string|max:255',
            'category_id'          => 'nullable|exists:categories,id',
            'description'          => 'required|string|max:5000',
            'attachment'           => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
            'g-recaptcha-response' => ['required', new RecaptchaValidation()],
        ], [
            'client_name.required'          => 'Nama lengkap wajib diisi.',
            'client_email.required'         => 'Email wajib diisi.',
            'client_email.email'            => 'Format email tidak valid.',
            'title.required'                => 'Judul laporan wajib diisi.',
            'category_id.exists'            => 'Kategori tidak valid.',
            'description.required'          => 'Deskripsi wajib diisi.',
            'description.max'               => 'Deskripsi tidak boleh lebih dari 5000 karakter.',
            'attachment.mimes'              => 'Format file tidak didukung. Gunakan: JPG, PNG, PDF, DOC, DOCX.',
            'attachment.max'                => 'Ukuran file maksimal 5MB.',
            'g-recaptcha-response.required' => 'Verifikasi reCAPTCHA wajib diisi.',
        ]);

        // ── [FIX #2] Ticket code tidak bisa ditebak ───────────────────────────
        // SEBELUM: rand(10000, 99999) → hanya 90.000 kombinasi, mudah di-brute-force
        // SESUDAH: Str::random(8) → ~220 triliun kombinasi, menggunakan CSPRNG
        do {
            $ticketCode = 'TKT-' . strtoupper(Str::random(8));
        } while (Ticket::where('ticket_code', $ticketCode)->exists());

        // ── [FIX #3] Sanitasi input sebelum disimpan ke DB ────────────────────
        // strip_tags() membuang semua tag HTML/JS sehingga data kotor
        // tidak tersimpan dan tidak bisa memicu XSS saat ditampilkan kembali
        $clientName  = strip_tags(trim($validated['client_name']));
        $title       = strip_tags(trim($validated['title']));
        $description = strip_tags(trim($validated['description']));

        // Handle file upload (belum diubah, akan diupgrade saat deploy)
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        // ── [FIX #1] Hanya kirim kolom yang diizinkan ke create() ─────────────
        // JANGAN pakai Ticket::create($request->all()) atau $validated langsung
        $ticket = Ticket::create([
            'ticket_code'  => $ticketCode,
            'client_name'  => $clientName,
            'client_email' => $validated['client_email'],
            'title'        => $title,
            'category_id'  => $validated['category_id'],
            'description'  => $description,
            'attachment'   => $attachmentPath,
            'status'       => 'open',
            'priority'     => 'medium',
        ]);

        // Kirim email notifikasi
        try {
            Mail::to($ticket->client_email)->send(new TicketCreated($ticket));

            $adminEmail = config('mail.admin_email');
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new \App\Mail\TicketCreatedAdmin($ticket));
            }

            Log::info('Email sent successfully for ticket: ' . $ticketCode);
        } catch (\Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage());
        }

        return redirect()
            ->route('user.home')
            ->with('success', 'Tiket #' . $ticketCode . ' berhasil dibuat! Cek email Anda untuk detailnya.');
    }

    public function success($ticketCode)
    {
        $ticket = Ticket::where('ticket_code', $ticketCode)->firstOrFail();

        return view('user.tickets.success', compact('ticket'));
    }
}
