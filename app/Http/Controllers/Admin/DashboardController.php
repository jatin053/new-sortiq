<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\ClientLogo;
use App\Models\Portfolio;
use App\Models\Review;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            'blogs' => Blog::count(),
            'portfolios' => Portfolio::count(),
            'reviews' => Review::count(),
            'clientLogos' => ClientLogo::count(),
        ];

        return view('admin.dashboard.dashboard-list', [
            'stats' => $stats,
        ]);
    }
}