<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactMessage $contactMessage)
    {
    }

    public function envelope(): Envelope
    {
        $replyTo = [];
        if (!empty($this->contactMessage->email) && filter_var($this->contactMessage->email, FILTER_VALIDATE_EMAIL)) {
            $replyTo[] = new Address($this->contactMessage->email, $this->contactMessage->name ?: '');
        }

        return new Envelope(
            subject: 'New contact enquiry: '.$this->contactMessage->subject,
            replyTo: $replyTo,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-message-notification',
        );
    }

    public function attachments(): array
    {
        if ($this->contactMessage->attachment && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->contactMessage->attachment)) {
            return [
                \Illuminate\Mail\Mailables\Attachment::fromStorageDisk('public', $this->contactMessage->attachment),
            ];
        }

        return [];
    }
}