<?php

namespace App\Livewire\User;

use App\Models\Ticket;
use App\Models\TicketReply;
use App\Events\NewChatMessage;
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

        if (session('tracked_ticket_code') !== $this->ticket->ticket_code) {
            abort(403);
        }

        $this->loadMessages();
    }

    public function loadMessages()
    {
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
            'user_id'     => null,
            'message'     => $this->message,
            'sender_type' => 'user',
        ]);

        // Broadcast ke admin (toOthers supaya tidak balik ke pengirim)
        broadcast(new NewChatMessage(
            $this->message,
            $this->ticket->id,
            $this->ticket->client_name,
            'user'
        ))->toOthers();

        // Local append optimization directly to memory
        $this->messages[] = [
            'id'          => $reply->id,
            'message'     => $reply->message,
            'sender_type' => $reply->sender_type,
            'sender_name' => $this->ticket->client_name,
            'created_at'  => $reply->created_at->format('d M Y, H:i'),
            'timestamp'   => $reply->created_at->toIso8601String(),
        ];

        $this->message = '';
        $this->dispatch('scroll-to-bottom');
    }



    #[On('echo:ticket.{ticket.id},.chat-message')]
    public function handleNewMessage($payload)
    {
        $this->messages[] = [
            'id'          => uniqid(),
            'message'     => $payload['message'] ?? '',
            'sender_type' => $payload['senderType'] ?? 'admin',
            'sender_name' => $payload['sender'] ?? 'Admin',
            'created_at'  => \Carbon\Carbon::parse($payload['timestamp'] ?? now())->format('d M Y, H:i'),
            'timestamp'   => $payload['timestamp'] ?? now()->toIso8601String(),
        ];
        
        $this->dispatch('scroll-to-bottom');
    }

    public function render()
    {
        return view('livewire.user.ticket-chat');
    }

    public function dispatchScrollToBottom()
    {
        $this->dispatch('scroll-to-bottom');
    }
}
