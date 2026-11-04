<form action="{{ $action }}" method="post" class="review-form" novalidate>
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    @php($reviewContent = old('content', $review['content']))

    <div class="review-edit-grid">
        <section class="review-editor-main">
            <label class="screen-reader-text" for="review-title">Review title</label>
            <input
                id="review-title"
                class="title-input @error('name') is-invalid @enderror"
                name="name"
                type="text"
                value="{{ old('name', $review['name']) }}"
                placeholder="Enter review title"
            >
            @error('name')
                <p class="field-error">{{ $message }}</p>
            @enderror

            <p class="permalink">
                Permalink:
                <a href="{{ $permalink }}">{{ $permalink }}</a>
            </p>

            <input type="hidden" name="slug" value="{{ old('slug', $review['slug']) }}">

            <div class="classic-editor review-content-panel">
                <label class="screen-reader-text" for="review-content">Review content</label>
                <textarea
                    id="review-content"
                    class="review-content @error('content') is-invalid @enderror"
                    name="content"
                    aria-label="Review content"
                    placeholder="Write the full customer review here"
                >{{ $reviewContent }}</textarea>

                <div class="editor-footer">
                    <span>Word count: {{ str_word_count(strip_tags($reviewContent)) }}</span>
                </div>
            </div>
            @error('content')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </section>

        <aside class="review-side">
            @include('admin.reviews.partials.publish-box', [
                'review' => $review,
                'submitLabel' => $submitLabel,
            ])

            <div class="meta-box">
                <div class="meta-title">Review Details</div>
                <div class="meta-body review-fields">
                    <label>
                        Platform
                        <select name="platform" class="@error('platform') is-invalid @enderror">
                            <option value="">Select platform</option>
                            @foreach ($platforms as $platform)
                                <option value="{{ $platform }}" @selected(old('platform', $review['platform']) === $platform)>
                                    {{ $platform }}
                                </option>
                            @endforeach
                        </select>
                        @error('platform')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label>
                        Position
                        <input
                            class="@error('position') is-invalid @enderror"
                            name="position"
                            type="text"
                            value="{{ old('position', $review['position']) }}"
                            placeholder="Founder, Marketing Lead, Product Manager"
                        >
                        @error('position')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label>
                        Rating
                        <select name="rating" class="@error('rating') is-invalid @enderror">
                            @for ($rating = 5; $rating >= 1; $rating--)
                                <option value="{{ $rating }}" @selected((int) old('rating', $review['rating']) === $rating)>
                                    {{ $rating }} {{ $rating === 1 ? 'Star' : 'Stars' }}
                                </option>
                            @endfor
                        </select>
                        @error('rating')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label>
                        Review Date
                        <input
                            class="@error('published_at') is-invalid @enderror"
                            name="published_at"
                            type="date"
                            value="{{ old('published_at', $review['published_at']) }}"
                        >
                        @error('published_at')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label>
                        Short Line
                        <textarea
                            class="@error('summary') is-invalid @enderror"
                            name="summary"
                            placeholder="Short summary used in listings"
                        >{{ old('summary', $review['summary']) }}</textarea>
                        @error('summary')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
            </div>
        </aside>
    </div>
</form>
