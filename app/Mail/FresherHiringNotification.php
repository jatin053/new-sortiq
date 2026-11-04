<?php

namespace App\Mail;

use App\Models\FresherHiring;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FresherHiringNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public FresherHiring $fresherHiring)
    {
    }

    public function envelope(): Envelope
    {
        $replyTo = [];
        if (!empty($this->fresherHiring->email) && filter_var($this->fresherHiring->email, FILTER_VALIDATE_EMAIL)) {
            $replyTo[] = new Address($this->fresherHiring->email, $this->fresherHiring->name ?: '');
        }

        return new Envelope(
            subject: 'New Fresher Hiring Submission: Connect Request',
            replyTo: $replyTo,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.fresher-hiring-notification',
        );
    }

    public function attachments(): array
    {
        if ($this->fresherHiring->attachment && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->fresherHiring->attachment)) {
            return [
                \Illuminate\Mail\Mailables\Attachment::fromStorageDisk('public', $this->fresherHiring->attachment),
            ];
        }

        return [];
    }
}
