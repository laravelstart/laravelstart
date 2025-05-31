<?php

namespace App\Mail;

use App\Models\StarterKit;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewStarterKitMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private readonly StarterKit $kit,
        private readonly User $user
    )
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "{$this->kit->title} is out!",
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.new-kit-mail',
            with: [
                'kit' => $this->kit,
                'user' => $this->user,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
