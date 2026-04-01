<?php

namespace App\Mail;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketReplied extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $reply;
    public $adminName;

    /**
     * Create a new message instance.
     */
    public function __construct(Ticket $ticket, TicketReply $reply, $adminName)
    {
        $this->ticket = $ticket;
        $this->reply = $reply;
        $this->adminName = $adminName;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = 'Balasan Baru untuk Tiket #' . $this->ticket->ticket_code;

        return $this->subject($subject)
                    ->view('emails.ticket_replied');
    }
}
