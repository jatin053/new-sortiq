<?php

namespace App\Mail;

use App\Models\InternshipApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

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

        $domain = $this->application->technology ?: 'General';

        return new Envelope(
            subject: "[INTERNSHIP] New Application: {$this->application->name} - {$domain}",
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
        $attachments = [];
        $filePath = $this->application->resume ?: ($this->application->attachment ?? null);

        if (!empty($filePath)) {
            if (Storage::disk('public')->exists($filePath)) {
                $attachments[] = Attachment::fromStorageDisk('public', $filePath);
            } else {
                $absPath = storage_path('app/public/' . ltrim($filePath, '/'));
                if (is_file($absPath)) {
                    $attachments[] = Attachment::fromPath($absPath);
                } else {
                    $pubPath = public_path(ltrim($filePath, '/'));
                    if (is_file($pubPath)) {
                        $attachments[] = Attachment::fromPath($pubPath);
                    }
                }
            }
        }

        return $attachments;
    }
}
