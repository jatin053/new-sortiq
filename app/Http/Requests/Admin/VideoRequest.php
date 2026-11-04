<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Video;

class VideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        // Generate slug if not provided
        $slug = $this->input('slug') ?: Str::slug($this->input('title'));

        $this->merge([
            'slug' => $slug,
        ]);
    }

    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:160',

            'slug' => [
                'required',
                'alpha_dash',
                'max:180',
                Rule::unique('videos', 'slug')
                    ->ignore($this->route('video')),
            ],

            'youtube_url' => 'nullable|string|max:500',
            'thumbnail' => 'nullable|string|max:255',
            'thumbnail_file' => 'nullable|file|mimes:webp,png,jpg,jpeg|max:4096',
            'summary' => 'nullable|string|max:500',
            'published_at' => 'required|date',
            'status' => 'required|in:draft,published',
            'sort_order' => 'required|integer|min:0|max:9999',
        ];

        if (Video::supportsVideoFileUploads()) {
            $rules['video_file'] = 'nullable|string|max:255';
            $rules['video_file_upload'] = 'nullable|file|mimetypes:video/mp4,video/webm,video/ogg,video/quicktime,video/x-m4v|max:102400';
        }

        return $rules;
    }

    public function after(): array
    {
        return [
            function ($validator): void {
                if ($this->hasVideoSource()) {
                    return;
                }

                $validator->errors()->add('youtube_url', 'Add a YouTube URL or upload a video file.');
            },
        ];
    }

    private function currentVideoHasSource(): bool
    {
        $video = $this->route('video');

        if (! $video instanceof Video) {
            return false;
        }

        return (Video::supportsVideoFileUploads() && filled($video->video_file)) || filled($video->youtube_url);
    }

    private function hasVideoSource(): bool
    {
        if (filled($this->input('youtube_url'))) {
            return true;
        }

        if (Video::supportsVideoFileUploads() && ($this->hasFile('video_file_upload') || filled($this->input('video_file')))) {
            return true;
        }

        return $this->currentVideoHasSource();
    }
}
