<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketTrackController extends Controller
{
    /**
     * Show form untuk track ticket
     */
    public function showTrackForm()
    {
        return view('user.tickets.track');
    }

    /**
     * Process tracking request
     */
    public function track(Request $request)
    {
        $request->validate([
            'ticket_code' => 'required|string|max:20'
        ], [
            'ticket_code.required' => 'Kode tiket wajib diisi'
        ]);

        // Normalize ticket code
        $ticketCode = strtoupper(trim($request->ticket_code));

        // Cari ticket berdasarkan code saja
        $ticket = Ticket::where('ticket_code', $ticketCode)->first();

        if (!$ticket) {
            return back()->withErrors([
                'ticket_code' => 'Tiket tidak ditemukan. Pastikan kode tiket sudah benar.'
            ])->withInput();
        }

        // Redirect ke halaman detail ticket
        return redirect()->route('user.tickets.track.result', $ticket->ticket_code);
    }

    /**
     * Show track result detail
     */
    public function showTrackResult($ticket_code)
    {
        // Normalize ticket code
        $ticketCode = strtoupper(trim($ticket_code));

        $ticket = Ticket::where('ticket_code', $ticketCode)->firstOrFail();

        return view('user.tickets.track-result', compact('ticket'));
    }

    /**
     * Show public ticket detail (alias untuk showTrackResult)
     */
    public function showPublic($ticket_code)
    {
        return $this->showTrackResult($ticket_code);
    }

    /**
     * Helper method untuk mapping status (optional)
     */
    private function getStatusConfig($status)
    {
        $configs = [
            'opn' => [
                'label' => 'Dibuka',
                'color' => 'blue',
                'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                'badge_class' => 'bg-blue-100 text-blue-700 border-blue-200'
            ],
            'progress' => [
                'label' => 'Sedang Diproses',
                'color' => 'yellow',
                'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
                'badge_class' => 'bg-yellow-100 text-yellow-700 border-yellow-200'
            ],
            'resolved' => [
                'label' => 'Selesai',
                'color' => 'green',
                'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                'badge_class' => 'bg-green-100 text-green-700 border-green-200'
            ],
            'closed' => [
                'label' => 'Ditutup',
                'color' => 'gray',
                'icon' => 'M6 18L18 6M6 6l12 12',
                'badge_class' => 'bg-gray-100 text-gray-700 border-gray-200'
            ],
        ];

        return $configs[$status] ?? $configs['opn'];
    }
}
