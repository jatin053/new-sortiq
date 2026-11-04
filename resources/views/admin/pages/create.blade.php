@extends('admin.layouts.app')

@section('title', 'Add New Page')

@section('content')
    <div style="padding: 10px 0;">
        <div class="wp-pages-header">
            <h1 class="wp-heading-inline">Add New Page</h1>
            <a href="{{ route('admin.site-pages.index') }}" class="page-title-action">← All Pages</a>
        </div>

        @if ($errors->any())
            <div style="padding: 10px 14px; background: #fcf0f2; border-left: 4px solid #d63638; border: 1px solid #f8d7da; font-size: 13px; color: #b32d2e; margin-bottom: 16px;">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.site-pages.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="wp-postbox">
                <div class="wp-postbox-header">
                    Page Details & Attributes
                </div>
                <div class="wp-postbox-body" style="display: flex; flex-direction: column; gap: 16px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 6px; color: #1d2327;">
                                Page Title / Label <span style="color: #d63638;">*</span>
                            </label>
                            <input type="text" name="label" value="{{ old('label') }}" placeholder="e.g. Pricing & Plans" required style="width: 100%; padding: 7px 10px; border: 1px solid #8c8f94; border-radius: 3px; font-size: 13px;">
                        </div>

                        <div>
                            <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 6px; color: #1d2327;">
                                Section Category <span style="color: #d63638;">*</span>
                            </label>
                            <select name="section" style="width: 100%; padding: 7px 10px; border: 1px solid #8c8f94; border-radius: 3px; font-size: 13px; background: #ffffff;">
                                <option value="Company Pages" @selected(old('section') === 'Company Pages')>Company Pages</option>
                                <option value="Service Pages" @selected(old('section') === 'Service Pages')>Service Pages</option>
                                <option value="Content Pages" @selected(old('section') === 'Content Pages')>Content Pages</option>
                                <option value="Custom Pages" @selected(old('section', 'Custom Pages') === 'Custom Pages')>Custom Pages</option>
                            </select>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 16px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 6px; color: #1d2327;">
                                URL Slug / Permalink <span style="color: #d63638;">*</span>
                            </label>
                            <input type="text" name="slug" value="{{ old('slug') }}" placeholder="e.g. pricing" required style="width: 100%; padding: 7px 10px; border: 1px solid #8c8f94; border-radius: 3px; font-size: 13px;">
                            <small style="color: #646970; font-size: 12px; margin-top: 4px; display: block;">Permalink will be registered under <code>/slug</code> on your site.</small>
                        </div>

                        <div>
                            <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 6px; color: #1d2327;">
                                Initial Status <span style="color: #d63638;">*</span>
                            </label>
                            <select name="status" style="width: 100%; padding: 7px 10px; border: 1px solid #8c8f94; border-radius: 3px; font-size: 13px; background: #ffffff;">
                                <option value="published" @selected(old('status', 'published') === 'published')>Published</option>
                                <option value="draft" @selected(old('status') === 'draft')>Draft</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wp-postbox">
                <div class="wp-postbox-header">
                    SEO & Social Sharing Metadata
                </div>
                <div class="wp-postbox-body" style="display: flex; flex-direction: column; gap: 16px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 6px; color: #1d2327;">
                            SEO Title Tag
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Pricing & Plans | Sortiq Solutions" style="width: 100%; padding: 7px 10px; border: 1px solid #8c8f94; border-radius: 3px; font-size: 13px;">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 6px; color: #1d2327;">
                            Meta Description
                        </label>
                        <textarea name="description" rows="3" placeholder="Enter meta description for search engines..." style="width: 100%; padding: 7px 10px; border: 1px solid #8c8f94; border-radius: 3px; font-size: 13px;">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 6px; color: #1d2327;">
                            Meta Keywords
                        </label>
                        <input type="text" name="keywords" value="{{ old('keywords') }}" placeholder="e.g. pricing, web development cost, plans" style="width: 100%; padding: 7px 10px; border: 1px solid #8c8f94; border-radius: 3px; font-size: 13px;">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 6px; color: #1d2327;">
                            Social Sharing Image (OG Image)
                        </label>
                        <input type="file" name="social_image" accept="image/*" style="width: 100%; padding: 7px 10px; border: 1px solid #8c8f94; border-radius: 3px; font-size: 13px; background: #ffffff;">
                        <small style="color: #646970; font-size: 12px; margin-top: 4px; display: block;">Upload a 1200x630px JPG or PNG image for social media links (WhatsApp, LinkedIn, Facebook).</small>
                    </div>
                </div>
            </div>

            <div style="margin-top: 16px; display: flex; gap: 10px; align-items: center;">
                <button type="submit" class="button button-primary" style="background: #2271b1; color: #ffffff; border: 1px solid #2271b1; border-radius: 3px; padding: 6px 14px; font-weight: 600; font-size: 13px; cursor: pointer;">
                    Publish Page
                </button>
                <a href="{{ route('admin.site-pages.index') }}" style="color: #2271b1; font-size: 13px; text-decoration: none;">Cancel</a>
            </div>
        </form>
    </div>
@endsection
    