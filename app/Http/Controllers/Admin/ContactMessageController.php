<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(Request $request): View
    {
        $searchTerm = trim($request->query('search', ''));
        $status = $request->query('status');
        $filter = $request->query('filter', 'inquiry');

        // Validate status
        if ($status !== 'read' && $status !== 'unread') {
            $status = null;
        }

        // Base query
        $query = ContactMessage::query();

        // Apply filter (inquiry vs application)
        if ($filter === 'application') {
            $query->where('type', '!=', 'contact');
        } else {
            $query->where('type', 'contact');
        }

        // Search filter
        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%$searchTerm%")
                    ->orWhere('email', 'like', "%$searchTerm%")
                    ->orWhere('subject', 'like', "%$searchTerm%")
                    ->orWhere('message', 'like', "%$searchTerm%")
                    ->orWhere('url', 'like', "%$searchTerm%");
            });
        }

        // Clone for tab counts
        $tabQuery = clone $query;

        // Status filter
        if ($status) {
            $query->where('status', $status);
        }

        // Get messages
        $messages = $query->latestFirst()->paginate(10)->withQueryString();

        // Stats (overall filtered by current view)
        $stats = [
            'total' => ($filter === 'application') ? ContactMessage::where('type', '!=', 'contact')->count() : ContactMessage::where('type', 'contact')->count(),
            'unread' => ($filter === 'application') ? ContactMessage::where('type', '!=', 'contact')->where('status', 'unread')->count() : ContactMessage::where('type', 'contact')->where('status', 'unread')->count(),
            'read' => ($filter === 'application') ? ContactMessage::where('type', '!=', 'contact')->where('status', 'read')->count() : ContactMessage::where('type', 'contact')->where('status', 'read')->count(),
        ];

        // Tab counts (filtered)
        $tabCounts = [
            'all' => $tabQuery->count(),
            'unread' => (clone $tabQuery)->where('status', 'unread')->count(),
            'read' => (clone $tabQuery)->where('status', 'read')->count(),
        ];

        return view('admin.contact-messages.message-list', [
            'messages' => $messages,
            'searchTerm' => $searchTerm,
            'activeStatus' => $status,
            'currentFilter' => $filter,
            'stats' => $stats,
            'tabCounts' => $tabCounts,
        ]);
    }

    public function show(ContactMessage $contactMessage): View
    {
        // Mark message as read
        if ($contactMessage->status === 'unread') {
            $contactMessage->markAsRead();
        }

        return view('admin.contact-messages.show', [
            'contactMessage' => $contactMessage->fresh(),
        ]);
    }

    public function downloadAttachment(ContactMessage $contactMessage)
    {
        if (empty($contactMessage->attachment)) {
            abort(404, 'No attachment found.');
        }

        // We can check local disk storage directly
        if (!\Illuminate\Support\Facades\Storage::disk('public')->exists($contactMessage->attachment)) {
            abort(404, 'File does not exist on storage.');
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->download($contactMessage->attachment);
    }
}
