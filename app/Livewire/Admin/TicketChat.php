<?php

namespace App\Livewire\Admin;

use App\Events\NewChatMessage;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class TicketChat extends Component
{
    #[Locked]
    public $ticket;
    public $message = '';
    public $messages = [];

    protected $rules = [
        'message' => 'required|string|max:2000',
    ];

    public function mount($ticketId)
    {
        $this->ticket = Ticket::with(['replies' => function ($q) {
            $q->orderBy('created_at', 'asc');
        }])->findOrFail($ticketId);

        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->ticket->load(['replies' => function ($q) {
            $q->orderBy('created_at', 'asc');
        }]);

        $this->messages = $this->ticket->replies->map(function ($reply) {
            return [
                'id'          => $reply->id,
                'message'     => $reply->message,
                'sender_type' => $reply->sender_type,
                'sender_name' => $reply->sender_type === 'admin'
                    ? ($reply->user->name ?? 'Admin')
                    : $this->ticket->client_name,
                'created_at'  => $reply->created_at->format('d M Y, H:i'),
                'timestamp'   => $reply->created_at->toIso8601String(),
            ];
        })->toArray();
    }



    public function sendMessage()
    {
        if ($this->ticket->status === 'closed') {
            $this->dispatch('error', 'Tiket sudah ditutup, tidak dapat mengirim pesan.');
            return;
        }

        $this->validate();

        $reply = TicketReply::create([
            'ticket_id'   => $this->ticket->id,
            'user_id'     => Auth::id(),
            'message'     => $this->message,
            'sender_type' => 'admin',
        ]);

        broadcast(new NewChatMessage(
            $this->message,
            $this->ticket->id,
            Auth::user()->name,
            'admin'
        ))->toOthers();

        // Local append optimization
        $this->messages[] = [
            'id'          => $reply->id,
            'message'     => $reply->message,
            'sender_type' => $reply->sender_type,
            'sender_name' => Auth::user()->name,
            'created_at'  => $reply->created_at->format('d M Y, H:i'),
            'timestamp'   => $reply->created_at->toIso8601String(),
        ];

        $this->message = '';
        $this->dispatch('scroll-to-bottom');
    }


    #[On('echo:ticket.{ticket.id},.chat-message')]
    public function handleNewMessage($payload)
    {
        // Append manually from broadcast payload to save 1 query
        $this->messages[] = [
            'id'          => uniqid(),
            'message'     => $payload['message'] ?? '',
            'sender_type' => $payload['senderType'] ?? 'user',
            'sender_name' => $payload['sender'] ?? 'User',
            'created_at'  => \Carbon\Carbon::parse($payload['timestamp'] ?? now())->format('d M Y, H:i'),
            'timestamp'   => $payload['timestamp'] ?? now()->toIso8601String(),
        ];
        
        $this->dispatch('scroll-to-bottom');
    }

    public function render()
    {
        return view('livewire.admin.ticket-chat');
    }

    public function dispatchScrollToBottom()
    {
        $this->dispatch('scroll-to-bottom');
    }
}
