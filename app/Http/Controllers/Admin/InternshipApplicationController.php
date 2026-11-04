<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InternshipApplicationController extends Controller
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
        $query = InternshipApplication::query();

        // Search filter
        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%$searchTerm%")
                    ->orWhere('email', 'like', "%$searchTerm%")
                    ->orWhere('institute', 'like', "%$searchTerm%")
                    ->orWhere('technology', 'like', "%$searchTerm%")
                    ->orWhere('subject', 'like', "%$searchTerm%")
                    ->orWhere('url', 'like', "%$searchTerm%");
            });
        }

        // Clone for tab counts
        $tabQuery = clone $query;

        // Status filter
        if ($status) {
            $query->where('status', $status);
        }

        // Get internship applications
        $applications = $query->latestFirst()->paginate(10)->withQueryString();

        // Stats (overall)
        $stats = [
            'total' => InternshipApplication::count(),
            'unread' => InternshipApplication::where('status', 'unread')->count(),
            'read' => InternshipApplication::where('status', 'read')->count(),
            'connected' => InternshipApplication::where('status', 'connected')->count(),
            'not_connected' => InternshipApplication::where('status', 'not_connected')->count(),
        ];

        // Tab counts (filtered)
        $tabCounts = [
            'all' => $tabQuery->count(),
            'unread' => (clone $tabQuery)->where('status', 'unread')->count(),
            'read' => (clone $tabQuery)->where('status', 'read')->count(),
            'connected' => (clone $tabQuery)->where('status', 'connected')->count(),
            'not_connected' => (clone $tabQuery)->where('status', 'not_connected')->count(),
        ];

        return view('admin.internship-applications.index', [
            'applications' => $applications,
            'searchTerm' => $searchTerm,
            'activeStatus' => $status,
            'stats' => $stats,
            'tabCounts' => $tabCounts,
        ]);
    }

    public function show(InternshipApplication $internshipApplication): View
    {
        // Mark as read
        if ($internshipApplication->status === 'unread') {
            $internshipApplication->markAsRead();
        }

        return view('admin.internship-applications.show', [
            'application' => $internshipApplication->fresh(),
        ]);
    }

    public function updateStatus(Request $request, InternshipApplication $internshipApplication)
    {
        $status = $request->input('status');

        if (in_array($status, ['unread', 'read', 'connected', 'not_connected'], true)) {
            $internshipApplication->forceFill([
                'status' => $status,
                'read_at' => ($status !== 'unread' && !$internshipApplication->read_at) ? now() : $internshipApplication->read_at,
            ])->save();
        }

        return redirect()->back()->with('status', 'Application status updated successfully.');
    }
}
