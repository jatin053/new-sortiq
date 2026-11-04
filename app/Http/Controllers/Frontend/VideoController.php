<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\View\View;
use Throwable;

class VideoController extends Controller
{
    public function index(): View
    {
        $videos = Video::query()
            ->published()
            ->ordered()
            ->where(function ($query) {
                $query->whereNotNull('youtube_url')
                    ->orWhereNotNull('video_file');
            })
            ->paginate(3);

        return view('frontend.videos.videos-page', compact('videos'));
    }
}
