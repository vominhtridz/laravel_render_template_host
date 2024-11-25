<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class verifyLinkEmail extends Mailable
{
    use Queueable, SerializesModels;
    private string $linkVerifyEmail;
    /**
     * Create a new message instance.
     */
    public function __construct($linkVerifyEmail)
    {
        $this->linkVerifyEmail = $linkVerifyEmail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Xác Thực email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'verify.verify',
        );
    }
    public function build(){
        return $this->view('verify.verify')
                    ->with('linkVerifyEmail', $this->linkVerifyEmail);
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
