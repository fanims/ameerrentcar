<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlacedUser extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Order Confirmation',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order.UserOrderConfirmation',
            with: ['order' => $this->order]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
