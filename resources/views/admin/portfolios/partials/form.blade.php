<form action="{{ $action }}" method="post" class="video-form" enctype="multipart/form-data" novalidate>
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="review-edit-grid">
        <section class="review-editor-main">
            <label class="screen-reader-text" for="portfolio-title">Portfolio title</label>
            <input
                id="portfolio-title"
                class="title-input @error('title') is-invalid @enderror"
                name="title"
                type="text"
                value="{{ old('title', $portfolio['title']) }}"
                placeholder="Enter project title"
            >
            @error('title')
                <p class="field-error">{{ $message }}</p>
            @enderror

            <p class="permalink">
                Permalink:
                <a href="{{ $permalink }}">{{ $permalink }}</a>
                <span class="small-btn">Edit</span>
            </p>

            <input type="hidden" name="slug" value="{{ old('slug', $portfolio['slug']) }}">

            <div class="meta-box">
                <div class="meta-title">Project Summary</div>
                <div class="meta-body review-fields">
                    <label>
                        Short Description
                        <textarea
                            class="@error('summary') is-invalid @enderror"
                            name="summary"
                            placeholder="Short description shown in portfolio cards"
                        >{{ old('summary', $portfolio['summary']) }}</textarea>
                        @error('summary')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label>
                        Full Description
                        <textarea
                            class="@error('content') is-invalid @enderror"
                            name="content"
                            rows="8"
                            placeholder="Optional project details for admin reference"
                        >{{ old('content', $portfolio['content']) }}</textarea>
                        @error('content')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
            </div>
        </section>

        <aside class="review-side">
            @include('admin.portfolios.partials.publish-box', [
                'portfolio' => $portfolio,
                'submitLabel' => $submitLabel,
            ])

            <div class="meta-box">
                <div class="meta-title">Portfolio Details</div>
                <div class="meta-body review-fields">
                    <label>
                        Project Image
                        <input type="hidden" name="image" value="{{ old('image', $portfolio['image']) }}">
                        <input
                            class="@error('image_file') is-invalid @enderror"
                            name="image_file"
                            type="file"
                            accept="image/webp,image/png,image/jpeg"
                        >
                        <span class="field-help">Upload a local portfolio image. The current image stays in place until you replace it.</span>
                        @error('image_file')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    @if ($portfolio->image_url)
                        <p class="current-logo-path">
                            Current file: <strong>{{ $portfolio['image'] }}</strong>
                        </p>
                    @endif

                    <label>
                        Project Preview URL
                        <input
                            class="@error('website_url') is-invalid @enderror"
                            name="website_url"
                            type="text"
                            value="{{ old('website_url', $portfolio['website_url']) }}"
                            placeholder="https://project-site.com or /flipbook/docs/index.html"
                        >
                        @error('website_url')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label>
                        Category
                        <select name="category_slug" class="@error('category_slug') is-invalid @enderror">
                            @foreach ($categories as $slug => $label)
                                <option value="{{ $slug }}" @selected(old('category_slug', $portfolio['category_slug']) === $slug)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_slug')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label>
                        Tags
                        <input name="tags_text" type="text" value="{{ old('tags_text', implode(', ', $portfolio->tags ?? [])) }}" placeholder="Example: Shopify, E-commerce, UI/UX">
                        <span class="field-help">Separate tags with commas. You can add up to 12 tags.</span>
                        @error('tags_text')<span class="field-error">{{ $message }}</span>@enderror
                    </label>

                    <label>
                        Publish Date
                        <input
                            class="@error('published_at') is-invalid @enderror"
                            name="published_at"
                            type="date"
                            value="{{ old('published_at', $portfolio->published_at?->format('Y-m-d')) }}"
                        >
                        @error('published_at')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label>
                        Display Order
                        <input
                            class="@error('sort_order') is-invalid @enderror"
                            name="sort_order"
                            type="number"
                            min="0"
                            value="{{ old('sort_order', $portfolio['sort_order']) }}"
                        >
                        @error('sort_order')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
            </div>
        </aside>
    </div>
</form>
