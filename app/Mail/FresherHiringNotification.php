<?php

namespace App\Mail;

use App\Models\FresherHiring;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

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
            subject: "[FRESHER CONNECT] New Application: {$this->fresherHiring->name} - " . ($this->fresherHiring->technology ?: 'Candidate'),
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
        $attachments = [];
        $filePath = $this->fresherHiring->attachment;

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
