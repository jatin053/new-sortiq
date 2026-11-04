<form action="{{ $action }}" method="post" class="video-form admin-entry-form" enctype="multipart/form-data" novalidate>
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    @php($supportsVideoFileUploads = \App\Models\Video::supportsVideoFileUploads())

    <input type="hidden" name="slug" value="{{ old('slug', $video['slug']) }}">

    <div class="admin-entry-grid">
        <div class="admin-entry-stack">
            <section class="admin-subpanel">
                <div class="admin-subpanel-head">
                    <span>Content</span>
                    <h3>Video basics</h3>
                </div>

                <div class="admin-subpanel-body">
                    <label class="admin-form-field" for="video-title">
                        <span>Title</span>
                        <input
                            id="video-title"
                            class="title-input @error('title') is-invalid @enderror"
                            name="title"
                            type="text"
                            value="{{ old('title', $video['title']) }}"
                            placeholder="Enter video title"
                        >
                    </label>
                    @error('title')
                        <p class="field-error">{{ $message }}</p>
                    @enderror

                    <div class="admin-permalink-box">
                        <span>Permalink</span>
                        <a href="{{ $permalink }}">{{ $permalink }}</a>
                    </div>

                    <label class="admin-form-field">
                        <span>Short Description</span>
                        <textarea
                            class="@error('summary') is-invalid @enderror"
                            name="summary"
                            rows="7"
                            placeholder="Short description shown for admin reference"
                        >{{ old('summary', $video['summary']) }}</textarea>
                    </label>
                    @error('summary')
                        <p class="field-error">{{ $message }}</p>
                    @enderror

                    <label class="admin-form-field">
                        <span>YouTube URL</span>
                        <input
                            class="@error('youtube_url') is-invalid @enderror"
                            name="youtube_url"
                            type="text"
                            value="{{ old('youtube_url', $video['youtube_url']) }}"
                            placeholder="Paste the full YouTube link or the 11-character video ID"
                        >
                        <span class="field-help">Use this for the current video records already saved in your admin panel.</span>
                    </label>
                    @error('youtube_url')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>
            </section>

            <section class="admin-subpanel">
                <div class="admin-subpanel-head">
                    <span>Preview</span>
                    <h3>Thumbnail preview</h3>
                </div>

                <div class="admin-subpanel-body">
                    <div class="admin-media-preview">
                        @if ($video->thumbnail_url)
                            <img src="{{ $video->thumbnail_url }}" alt="{{ $video['title'] ?: 'Video preview' }}">
                        @else
                            <span class="admin-detail-placeholder">No preview available</span>
                        @endif
                    </div>

                    <p class="admin-microcopy">
                        The preview uses the local thumbnail when available, otherwise it falls back to the local placeholder image.
                    </p>
                </div>
            </section>
        </div>

        <div class="admin-entry-stack">
            <section class="admin-subpanel">
                <div class="admin-subpanel-head">
                    <span>Publish</span>
                    <h3>Publishing settings</h3>
                </div>

                <div class="admin-subpanel-body">
                    <label class="admin-form-field">
                        <span>Status</span>
                        <select name="status" class="@error('status') is-invalid @enderror">
                            <option value="published" @selected(old('status', $video['status']) === 'published')>Published</option>
                            <option value="draft" @selected(old('status', $video['status']) === 'draft')>Draft</option>
                        </select>
                    </label>
                    @error('status')
                        <p class="field-error">{{ $message }}</p>
                    @enderror

                    <label class="admin-form-field">
                        <span>Publish Date</span>
                        <input
                            class="@error('published_at') is-invalid @enderror"
                            name="published_at"
                            type="date"
                            value="{{ old('published_at', $video->published_at?->format('Y-m-d')) }}"
                        >
                    </label>
                    @error('published_at')
                        <p class="field-error">{{ $message }}</p>
                    @enderror

                    <label class="admin-form-field">
                        <span>Display Order</span>
                        <input
                            class="@error('sort_order') is-invalid @enderror"
                            name="sort_order"
                            type="number"
                            min="0"
                            value="{{ old('sort_order', $video['sort_order']) }}"
                        >
                    </label>
                    @error('sort_order')
                        <p class="field-error">{{ $message }}</p>
                    @enderror

                    <div class="admin-key-value">
                        <div>
                            <span>Visibility</span>
                            <strong>Public</strong>
                        </div>
                        <div>
                            <span>Action</span>
                            <strong>{{ $submitLabel }}</strong>
                        </div>
                    </div>
                </div>
            </section>

            <section class="admin-subpanel">
                <div class="admin-subpanel-head">
                    <span>Source</span>
                    <h3>{{ $supportsVideoFileUploads ? 'Video source and media' : 'Thumbnail media' }}</h3>
                </div>

                <div class="admin-subpanel-body">
                    @if ($supportsVideoFileUploads)
                        <label class="admin-form-field">
                            <span>Video File</span>
                            <input type="hidden" name="video_file" value="{{ old('video_file', $video['video_file']) }}">
                            <input
                                class="@error('video_file_upload') is-invalid @enderror"
                                name="video_file_upload"
                                type="file"
                                accept="video/mp4,video/webm,video/ogg,video/quicktime,video/x-m4v"
                            >
                            <span class="field-help">Optional. Upload a local file if you want it to replace the YouTube source.</span>
                        </label>
                        @error('video_file')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                        @error('video_file_upload')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    @else
                        <p class="admin-microcopy">
                            This database is still using the YouTube-based video setup, so the frontend player uses the YouTube URL above.
                        </p>
                    @endif

                    <label class="admin-form-field">
                        <span>Thumbnail Image</span>
                        <input type="hidden" name="thumbnail" value="{{ old('thumbnail', $video['thumbnail']) }}">
                        <input
                            class="@error('thumbnail_file') is-invalid @enderror"
                            name="thumbnail_file"
                            type="file"
                            accept="image/webp,image/png,image/jpeg"
                        >
                        <span class="field-help">Upload a local thumbnail image for the card preview.</span>
                    </label>
                    @error('thumbnail_file')
                        <p class="field-error">{{ $message }}</p>
                    @enderror

                    @if ($supportsVideoFileUploads && $video['video_file'])
                        <p class="current-logo-path">
                            Current video: <strong>{{ $video['video_file'] }}</strong>
                        </p>
                    @elseif ($video['youtube_url'])
                        <p class="current-logo-path">
                            Current source: <strong>Legacy YouTube video</strong>
                        </p>
                        <p class="current-logo-path">
                            YouTube URL: <strong>{{ $video['youtube_url'] }}</strong>
                        </p>
                    @endif

                    @if ($video['thumbnail'])
                        <p class="current-logo-path">
                            Current thumbnail: <strong>{{ $video['thumbnail'] }}</strong>
                        </p>
                    @endif
                </div>
            </section>
        </div>
    </div>

    <div class="admin-form-actions">
        <a href="{{ route('admin.videos.index') }}" class="btn">Cancel</a>
        <button type="submit" class="primary-btn">{{ $submitLabel }}</button>
    </div>
</form>
