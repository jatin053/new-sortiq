<?php

namespace App\Mail;

use App\Models\InternshipApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InternshipApplicationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public InternshipApplication $application)
    {
    }

    public function envelope(): Envelope
    {
        $replyTo = [];
        if (!empty($this->application->email) && filter_var($this->application->email, FILTER_VALIDATE_EMAIL)) {
            $replyTo[] = new Address($this->application->email, $this->application->name ?: '');
        }

        return new Envelope(
            subject: 'New Internship Application Received',
            replyTo: $replyTo,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.internship-application-notification',
        );
    }

    public function attachments(): array
    {
        if ($this->application->resume && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->application->resume)) {
            return [
                \Illuminate\Mail\Mailables\Attachment::fromStorageDisk('public', $this->application->resume),
            ];
        }

        return [];
    }
}
