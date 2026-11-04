@extends('admin.layouts.app')

@section('title', 'Site Layout Settings')

@section('content')
    @include('admin.partials.page-hero', [
        'kicker' => 'Site Settings',
        'title' => 'Manage site layout settings.',
        'description' => 'Update the header, footer, logo, contact details, and navigation links.',
        'actions' => [
            [
                'type' => 'button',
                'label' => 'Save Changes',
                'class' => 'primary-btn',
                'button_type' => 'submit',
                'form' => 'site-layout-form',
            ],
        ],
    ])

    @if (session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    @php
        $imageUrl = function (?string $path): ?string {
            if (! $path) {
                return null;
            }

            return \App\Support\LocalMedia::url($path);
        };

        $navRows = array_pad($settings['nav_links'] ?? [], 8, ['label' => '', 'url' => '', 'has_dropdown' => '0']);
        $badgeRows = array_pad($settings['footer_badges'] ?? [], 8, ['label' => '', 'image' => '']);
    @endphp

    <form id="site-layout-form" action="{{ route('admin.site-layout.update') }}" method="post" enctype="multipart/form-data" class="site-settings-form" novalidate>
        @csrf
        @method('PUT')

        <div class="settings-grid">
            <section class="settings-panel">
                <div class="settings-panel-title">
                    <span>Header Brand</span>
                    <strong>Logo and top strip</strong>
                </div>

                <div class="settings-panel-body">
                    <div class="settings-logo-preview">
                        @if ($imageUrl($settings['header']['logo'] ?? ''))
                            <img src="{{ $imageUrl($settings['header']['logo']) }}" alt="{{ $settings['header']['logo_text'] }}">
                        @else
                            <span>{{ $settings['header']['logo_text'] }}</span>
                        @endif
                    </div>

                    <input type="hidden" name="header[logo]" value="{{ old('header.logo', $settings['header']['logo'] ?? '') }}">

                    <label class="settings-field">
                        Logo Image
                        <input type="file" name="header_logo_file" accept="image/*" class="@error('header_logo_file') is-invalid @enderror">
                        @error('header_logo_file')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="settings-field">
                        Logo Text
                        <input type="text" name="header[logo_text]" value="{{ old('header.logo_text', $settings['header']['logo_text']) }}" class="@error('header.logo_text') is-invalid @enderror">
                        @error('header.logo_text')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <div class="two-column-fields">
                        <label class="settings-field">
                            Top Phone
                            <input type="text" name="header[phone]" value="{{ old('header.phone', $settings['header']['phone']) }}">
                        </label>

                        <label class="settings-field">
                            Top Email
                            <input type="email" name="header[email]" value="{{ old('header.email', $settings['header']['email']) }}">
                        </label>
                    </div>

                    <div class="two-column-fields">
                        <label class="settings-field">
                            Internship Label
                            <input type="text" name="header[apply_label]" value="{{ old('header.apply_label', $settings['header']['apply_label']) }}">
                        </label>

                        <label class="settings-field">
                            Internship URL
                            <input type="text" name="header[apply_url]" value="{{ old('header.apply_url', $settings['header']['apply_url']) }}">
                        </label>
                    </div>
                </div>
            </section>

            <section class="settings-panel settings-preview-panel">
                <div class="settings-panel-title">
                    <span>Header Preview</span>
                    <strong>Desktop shape</strong>
                </div>

                <div class="header-admin-preview">
                    <div class="header-preview-top">
                        <span>{{ $settings['header']['phone'] }}</span>
                        <span>{{ $settings['header']['email'] }}</span>
                        <strong>{{ $settings['header']['apply_label'] }}</strong>
                    </div>
                    <div class="header-preview-main">
                        <div class="header-preview-logo">
                            @if ($imageUrl($settings['header']['logo'] ?? ''))
                                <img src="{{ $imageUrl($settings['header']['logo']) }}" alt="{{ $settings['header']['logo_text'] }}">
                            @else
                                <span>{{ $settings['header']['logo_text'] }}</span>
                            @endif
                        </div>
                        <div class="header-preview-nav">
                            @foreach (array_slice($settings['nav_links'], 0, 6) as $link)
                                <span>{{ $link['label'] }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section class="settings-panel">
            <div class="settings-panel-title">
                <span>Main Menu</span>
                <strong>Navigation links</strong>
            </div>

            <div class="settings-table">
                <div class="settings-table-head three-cols">
                    <span>Label</span>
                    <span>URL</span>
                    <span>Dropdown</span>
                </div>

                @foreach ($navRows as $index => $link)
                    <div class="settings-row three-cols">
                        <input type="text" name="nav_links[{{ $index }}][label]" value="{{ old("nav_links.$index.label", $link['label'] ?? '') }}" placeholder="Menu label">
                        <input type="text" name="nav_links[{{ $index }}][url]" value="{{ old("nav_links.$index.url", $link['url'] ?? '') }}" placeholder="/page-url">
                        <select name="nav_links[{{ $index }}][has_dropdown]">
                            <option value="0" @selected(old("nav_links.$index.has_dropdown", $link['has_dropdown'] ?? '0') === '0')>No</option>
                            <option value="1" @selected(old("nav_links.$index.has_dropdown", $link['has_dropdown'] ?? '0') === '1')>Yes</option>
                        </select>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="settings-panel">
            <div class="settings-panel-title">
                <span>Footer Badges</span>
                <strong>Top certification logos</strong>
            </div>

            <div class="badge-settings-grid">
                @foreach ($badgeRows as $index => $badge)
                    <div class="badge-settings-card">
                        <div class="badge-preview">
                            @if ($imageUrl($badge['image'] ?? ''))
                                <img src="{{ $imageUrl($badge['image']) }}" alt="{{ $badge['label'] }}">
                            @else
                                <span>{{ $badge['label'] ?: 'Badge' }}</span>
                            @endif
                        </div>

                        <input type="hidden" name="footer_badges[{{ $index }}][image]" value="{{ old("footer_badges.$index.image", $badge['image'] ?? '') }}">

                        <label class="settings-field">
                            Label
                            <input type="text" name="footer_badges[{{ $index }}][label]" value="{{ old("footer_badges.$index.label", $badge['label'] ?? '') }}">
                        </label>

                        <label class="settings-field">
                            Image
                            <input type="file" name="footer_badge_files[{{ $index }}]" accept="image/*">
                        </label>
                    </div>
                @endforeach
            </div>
        </section>

        <div class="settings-grid">
            <section class="settings-panel">
                <div class="settings-panel-title">
                    <span>Footer Contact</span>
                    <strong>Address and support</strong>
                </div>

                <div class="settings-panel-body">
                    <label class="settings-field">
                        Address
                        <textarea name="footer[address]">{{ old('footer.address', $settings['footer']['address']) }}</textarea>
                    </label>

                    <div class="two-column-fields">
                        <label class="settings-field">
                            Phone
                            <input type="text" name="footer[phone]" value="{{ old('footer.phone', $settings['footer']['phone']) }}">
                        </label>

                        <label class="settings-field">
                            Email
                            <input type="email" name="footer[email]" value="{{ old('footer.email', $settings['footer']['email']) }}">
                        </label>
                    </div>

                    <label class="settings-field">
                        Certificate Text
                        <textarea name="footer[certificate_text]">{{ old('footer.certificate_text', $settings['footer']['certificate_text']) }}</textarea>
                    </label>

                    <div class="two-column-fields">
                        <label class="settings-field">
                            Certificate Button
                            <input type="text" name="footer[certificate_button_label]" value="{{ old('footer.certificate_button_label', $settings['footer']['certificate_button_label']) }}">
                        </label>

                        <label class="settings-field">
                            Certificate URL
                            <input type="text" name="footer[certificate_url]" value="{{ old('footer.certificate_url', $settings['footer']['certificate_url']) }}">
                        </label>
                    </div>

                    <div class="two-column-fields">
                        <label class="settings-field">
                            Chat Label
                            <input type="text" name="footer[chat_label]" value="{{ old('footer.chat_label', $settings['footer']['chat_label']) }}">
                        </label>

                        <label class="settings-field">
                            Chat URL
                            <input type="text" name="footer[chat_url]" value="{{ old('footer.chat_url', $settings['footer']['chat_url']) }}">
                        </label>
                    </div>
                </div>
            </section>

            <section class="settings-panel settings-preview-panel">
                <div class="settings-panel-title">
                    <span>Footer Preview</span>
                    <strong>Contact strip</strong>
                </div>

                <div class="footer-admin-preview">
                    <div class="footer-preview-badges">
                        @foreach (array_slice($badgeRows, 0, 5) as $badge)
                            <span>{{ $badge['label'] ?: 'Badge' }}</span>
                        @endforeach
                    </div>
                    <div class="footer-preview-contact">
                        <p>{{ $settings['footer']['address'] }}</p>
                        <p>{{ $settings['footer']['phone'] }}</p>
                        <p>{{ $settings['footer']['email'] }}</p>
                    </div>
                    <button type="button">{{ $settings['footer']['certificate_button_label'] }}</button>
                </div>
            </section>
        </div>

        <div class="settings-columns-grid">
            @foreach ($footerColumnKeys as $columnKey)
                @php
                    $column = $settings['footer_columns'][$columnKey] ?? ['title' => '', 'links' => []];
                    $linkRows = array_pad($column['links'] ?? [], 12, ['label' => '', 'url' => '']);
                @endphp

                <section class="settings-panel">
                    <div class="settings-panel-title">
                        <span>{{ $column['title'] ?: ucfirst($columnKey) }}</span>
                        <strong>Footer column</strong>
                    </div>

                    <div class="settings-panel-body">
                        <label class="settings-field">
                            Column Title
                            <input type="text" name="footer_columns[{{ $columnKey }}][title]" value="{{ old("footer_columns.$columnKey.title", $column['title'] ?? '') }}">
                        </label>

                        <div class="settings-table compact">
                            <div class="settings-table-head two-cols">
                                <span>Label</span>
                                <span>URL</span>
                            </div>

                            @foreach ($linkRows as $index => $link)
                                <div class="settings-row two-cols">
                                    <input type="text" name="footer_columns[{{ $columnKey }}][links][{{ $index }}][label]" value="{{ old("footer_columns.$columnKey.links.$index.label", $link['label'] ?? '') }}" placeholder="Link label">
                                    <input type="text" name="footer_columns[{{ $columnKey }}][links][{{ $index }}][url]" value="{{ old("footer_columns.$columnKey.links.$index.url", $link['url'] ?? '') }}" placeholder="/page-url">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endforeach
        </div>

        <section class="settings-panel">
            <div class="settings-panel-title">
                <span>Recent Articles</span>
                <strong>Footer article links</strong>
            </div>

            <div class="settings-panel-body">
                <p class="text-sm text-slate-600">
                    Recent articles in the website footer are now pulled automatically from the latest published blog posts in the database.
                </p>
            </div>
        </section>

        <div class="settings-save-bar">
            <button type="submit" class="primary-btn">Save Header & Footer</button>
        </div>
    </form>
@endsection
