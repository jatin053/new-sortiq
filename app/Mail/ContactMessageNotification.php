<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

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

        $typeLabel = strtoupper($this->contactMessage->type ?: 'ENQUIRY');
        $subjectText = $this->contactMessage->subject ?: 'New Website Enquiry';

        return new Envelope(
            subject: "[{$typeLabel}] {$subjectText} - {$this->contactMessage->name}",
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
        $attachments = [];
        $filePath = $this->contactMessage->attachment;

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
