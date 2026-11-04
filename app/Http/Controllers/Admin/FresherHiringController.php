<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FresherHiring;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FresherHiringController extends Controller
{
    public function index(Request $request): View
    {
        $searchTerm = trim($request->query('search', ''));
        $status = $request->query('status');

        // Validate status
        if ($status !== 'read' && $status !== 'unread' && $status !== 'connected' && $status !== 'not_connected') {
            $status = null;
        }

        // Base query
        $query = FresherHiring::query();

        // Search filter
        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%$searchTerm%")
                    ->orWhere('email', 'like', "%$searchTerm%")
                    ->orWhere('institute', 'like', "%$searchTerm%")
                    ->orWhere('technology', 'like', "%$searchTerm%")
                    ->orWhere('url', 'like', "%$searchTerm%");
            });
        }

        // Clone for tab counts
        $tabQuery = clone $query;

        // Status filter
        if ($status) {
            $query->where('status', $status);
        }

        // Get fresher applications
        $freshers = $query->latestFirst()->paginate(10)->withQueryString();

        // Stats (overall)
        $stats = [
            'total' => FresherHiring::count(),
            'unread' => FresherHiring::where('status', 'unread')->count(),
            'read' => FresherHiring::where('status', 'read')->count(),
            'connected' => FresherHiring::where('status', 'connected')->count(),
            'not_connected' => FresherHiring::where('status', 'not_connected')->count(),
        ];

        // Tab counts (filtered)
        $tabCounts = [
            'all' => $tabQuery->count(),
            'unread' => (clone $tabQuery)->where('status', 'unread')->count(),
            'read' => (clone $tabQuery)->where('status', 'read')->count(),
            'connected' => (clone $tabQuery)->where('status', 'connected')->count(),
            'not_connected' => (clone $tabQuery)->where('status', 'not_connected')->count(),
        ];

        return view('admin.fresher-hirings.index', [
            'freshers' => $freshers,
            'searchTerm' => $searchTerm,
            'activeStatus' => $status,
            'stats' => $stats,
            'tabCounts' => $tabCounts,
        ]);
    }

    public function show(FresherHiring $fresherHiring): View
    {
        // Mark as read
        if ($fresherHiring->status === 'unread') {
            $fresherHiring->markAsRead();
        }

        return view('admin.fresher-hirings.show', [
            'fresher' => $fresherHiring->fresh(),
        ]);
    }

    public function updateStatus(Request $request, FresherHiring $fresherHiring)
    {
        $status = $request->input('status');

        if (in_array($status, ['unread', 'read', 'connected', 'not_connected'], true)) {
            $fresherHiring->forceFill([
                'status' => $status,
                'read_at' => ($status !== 'unread' && !$fresherHiring->read_at) ? now() : $fresherHiring->read_at,
            ])->save();
        }

        return redirect()->back()->with('status', 'Application status updated successfully.');
    }

    public function downloadAttachment(FresherHiring $fresherHiring)
    {
        if (empty($fresherHiring->attachment)) {
            abort(404, 'No attachment found.');
        }

        if (!\Illuminate\Support\Facades\Storage::disk('public')->exists($fresherHiring->attachment)) {
            abort(404, 'File does not exist on storage.');
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->download($fresherHiring->attachment);
    }
}
