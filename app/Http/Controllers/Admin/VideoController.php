<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VideoRequest;
use App\Models\Video;
use App\Support\LocalMedia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index(Request $request): View
    {
        $searchTerm = trim($request->query('search', ''));
        $status = $request->query('status');

        if ($status !== 'draft' && $status !== 'published') {
            $status = null;
        }

        $query = Video::query();

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('summary', 'like', "%{$searchTerm}%");
            });
        }

        $tabQuery = clone $query;

        if ($status) {
            $query->where('status', $status);
        }

        $videos = $query
            ->ordered()
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total' => Video::count(),
            'published' => Video::where('status', 'published')->count(),
            'draft' => Video::where('status', 'draft')->count(),
        ];

        $tabCounts = [
            'all' => $tabQuery->count(),
            'published' => (clone $tabQuery)->where('status', 'published')->count(),
            'draft' => (clone $tabQuery)->where('status', 'draft')->count(),
        ];

        return view('admin.videos.video-list', [
            'videos' => $videos,
            'searchTerm' => $searchTerm,
            'activeStatus' => $status,
            'stats' => $stats,
            'tabCounts' => $tabCounts,
        ]);
    }

    public function create(): View
    {
        $video = new Video([
            'status' => 'published',
            'published_at' => now(),
            'sort_order' => 0,
            'views' => 0,
        ]);

        return view('admin.videos.create-video', [
            'video' => $video,
            'permalink' => $this->getPermalink($video),
        ]);
    }

    public function store(VideoRequest $request): RedirectResponse
    {
        $video = Video::create($this->payload($request));

        return redirect()
            ->route('admin.videos.edit', $video)
            ->with('status', 'Video created successfully.');
    }

    public function show(Video $video): View
    {
        return view('admin.videos.video-details', [
            'video' => $video,
        ]);
    }

    public function edit(Video $video): View
    {
        return view('admin.videos.edit-video', [
            'video' => $video,
            'permalink' => $this->getPermalink($video),
        ]);
    }

    public function update(VideoRequest $request, Video $video): RedirectResponse
    {
        $video->update($this->payload($request, $video));

        return redirect()
            ->route('admin.videos.edit', $video)
            ->with('status', 'Video updated successfully.');
    }

    public function destroy(Video $video): RedirectResponse
    {
        if ($video->video_file) {
            LocalMedia::deleteUploadedFile($video->video_file);
        }

        if ($video->thumbnail) {
            LocalMedia::deleteUploadedFile($video->thumbnail);
        }

        $title = $video->title ?: 'Video';
        $video->delete();

        return redirect()
            ->route('admin.videos.index')
            ->with('status', "\"{$title}\" deleted successfully.");
    }

    public function toggleStatus(Video $video): RedirectResponse
    {
        $newStatus = $video->status === 'published' ? 'draft' : 'published';
        $video->update(['status' => $newStatus]);

        return back()->with('status', "\"{$video->title}\" status updated to " . ucfirst($newStatus) . '.');
    }

    public function bulkAction(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'action' => ['required', 'string', 'in:delete,published,draft'],
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:videos,id'],
        ]);

        $action = $data['action'];
        $ids = $data['ids'];

        if ($action === 'delete') {
            $videos = Video::query()->whereIn('id', $ids)->get();
            foreach ($videos as $v) {
                if ($v->video_file) {
                    LocalMedia::deleteUploadedFile($v->video_file);
                }
                if ($v->thumbnail) {
                    LocalMedia::deleteUploadedFile($v->thumbnail);
                }
                $v->delete();
            }
            $msg = count($ids) . ' video(s) deleted successfully.';
        } else {
            Video::query()->whereIn('id', $ids)->update(['status' => $action]);
            $msg = count($ids) . ' video(s) updated to ' . ucfirst($action) . '.';
        }

        return back()->with('status', $msg);
    }

    private function getPermalink(Video $video): string
    {
        $slug = $video->slug;

        if (empty($slug)) {
            $slug = Str::slug($video->title ?: 'new-video');
        }

        return url('videos#' . $slug);
    }

    private function payload(VideoRequest $request, ?Video $video = null): array
    {
        $data = $request->validated();

        unset($data['video_file_upload'], $data['thumbnail_file']);
        $data['youtube_url'] = trim((string) ($data['youtube_url'] ?? $video?->youtube_url ?? ''));

        if (Video::supportsVideoFileUploads()) {
            if ($request->hasFile('video_file_upload')) {
                if ($video) {
                    LocalMedia::deleteUploadedFile($video->video_file);
                }

                $data['video_file'] = LocalMedia::storeUploadedFile(
                    $request->file('video_file_upload'),
                    'uploads/videos',
                    $request->input('title', 'video-file')
                );
                $data['youtube_url'] = '';
            } elseif ($video) {
                $data['video_file'] = $video->video_file;
            }
        } else {
            unset($data['video_file']);
        }

        if ($request->hasFile('thumbnail_file')) {
            if ($video) {
                LocalMedia::deleteUploadedFile($video->thumbnail);
            }

            $data['thumbnail'] = LocalMedia::storeUploadedFile(
                $request->file('thumbnail_file'),
                'uploads/videos/thumbnails',
                $request->input('title', 'video-thumbnail')
            );
        } elseif ($video) {
            $data['thumbnail'] = $video->thumbnail;
        }

        return $data;
    }
}
