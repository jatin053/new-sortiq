<form action="{{ $action }}" method="post" class="client-logo-form" enctype="multipart/form-data" novalidate>
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="review-edit-grid client-logo-edit-grid">
        <section class="review-editor-main">
            <label class="screen-reader-text" for="client-logo-name">Client name</label>
            <input
                id="client-logo-name"
                class="title-input @error('name') is-invalid @enderror"
                name="name"
                type="text"
                value="{{ old('name', $clientLogo['name']) }}"
                placeholder="Enter client name"
            >
            @error('name')
                <p class="field-error">{{ $message }}</p>
            @enderror

            <p class="permalink">
                Permalink:
                <a href="{{ $permalink }}">{{ $permalink }}</a>
                <span class="small-btn">Edit</span>
            </p>

            <input type="hidden" name="slug" value="{{ old('slug', $clientLogo['slug']) }}">

        </section>

        <aside class="review-side">
            @include('admin.client-logos.partials.publish-box', [
                'clientLogo' => $clientLogo,
                'submitLabel' => $submitLabel,
            ])

            <div class="meta-box">
                <div class="meta-title">Logo Details</div>
                <div class="meta-body review-fields">
                    <label>
                        Logo Image
                        <input
                            class="@error('logo') is-invalid @enderror"
                            name="logo"
                            type="file"
                            accept="image/*"
                        >
                        <span class="field-help">Upload JPG, PNG, WEBP, GIF, or SVG up to 2 MB.</span>
                        @error('logo')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <p class="current-logo-path">
                        Current file: <strong>{{ $clientLogo['logo'] ?: 'No file selected yet.' }}</strong>
                    </p>

                    <label>
                        Website URL
                        <input
                            class="@error('website') is-invalid @enderror"
                            name="website"
                            type="url"
                            value="{{ old('website', $clientLogo['website']) }}"
                            placeholder="https://client-site.com"
                        >
                        @error('website')
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
                            value="{{ old('sort_order', $clientLogo['sort_order']) }}"
                        >
                        @error('sort_order')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label>
                        Short Description
                        <textarea
                            class="@error('description') is-invalid @enderror"
                            name="description"
                            placeholder="Small note for admin reference"
                        >{{ old('description', $clientLogo['description']) }}</textarea>
                        @error('description')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
            </div>
        </aside>
    </div>
</form>

