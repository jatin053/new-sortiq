@extends('admin.layouts.app')

@section('title', 'Custom Header & Footer Code')

@section('content')
    <div class="custom-code-page">
        <section class="custom-code-intro">
            <span>Site Settings</span>
            <h1>Header &amp; Footer Code Injection</h1>
            <p>Paste analytics, tracking pixels, meta tags, custom CSS, and scripts to inject site-wide across all pages.</p>
        </section>

        @if (session('status'))
            <div class="success-box">{{ session('status') }}</div>
        @endif

        <form id="custom-code-form" action="{{ route('admin.site-layout.custom-code.update') }}" method="post" class="site-settings-form">
            @csrf
            @method('PUT')

            <div class="settings-grid custom-code-layout" style="display: flex; flex-direction: column; gap: 24px;">
                <!-- Header Code Section -->
                <section class="settings-panel">
                    <div class="settings-panel-title">
                        <span style="color: #2563eb; font-weight: 800; text-transform: uppercase; font-size: 11px; letter-spacing: 0.05em;">Header Scripts (&lt;head&gt;)</span>
                        <strong>Injected inside &lt;head&gt; across all pages</strong>
                    </div>
                    <div class="settings-panel-body">
                        <label class="settings-field">
                            Header Code
                            <textarea name="custom_code[head]" rows="14" class="code-editor @error('custom_code.head') is-invalid @enderror" spellcheck="false" placeholder="<!-- Paste code that belongs in <head>, such as Google Analytics (gtag.js), Meta Pixel, Google Tag Manager, Search Console verification meta tags, custom <style> CSS, etc. -->">{{ old('custom_code.head', $customCode['head'] ?? '') }}</textarea>
                            <small>This code is injected right before <code>&lt;/head&gt;</code> on every page. Ideal for Google Analytics, Meta Pixel, GTM, site verification tags, and CSS styling.</small>
                            @error('custom_code.head')<span class="field-error">{{ $message }}</span>@enderror
                        </label>
                    </div>
                </section>

                <!-- Footer Code Section -->
                <section class="settings-panel">
                    <div class="settings-panel-title">
                        <span style="color: #16a34a; font-weight: 800; text-transform: uppercase; font-size: 11px; letter-spacing: 0.05em;">Footer Scripts (&lt;body&gt;)</span>
                        <strong>Injected before &lt;/body&gt; across all pages</strong>
                    </div>
                    <div class="settings-panel-body">
                        <label class="settings-field">
                            Footer Code
                            <textarea name="custom_code[body]" rows="14" class="code-editor @error('custom_code.body') is-invalid @enderror" spellcheck="false" placeholder="<!-- Paste code that belongs before </body>, such as Live Chat widgets (Tawk.to, WhatsApp, Crisp), conversion tracking, Google Tag Manager <noscript>, custom <script> JS, etc. -->">{{ old('custom_code.body', $customCode['body'] ?? '') }}</textarea>
                            <small>This code is injected right before the closing <code>&lt;/body&gt;</code> tag on every page. Ideal for live chat widgets, popup widgets, tracking scripts, and footer JavaScript.</small>
                            @error('custom_code.body')<span class="field-error">{{ $message }}</span>@enderror
                        </label>
                    </div>
                </section>
            </div>

            <div class="settings-save-bar custom-code-save-bar">
                <button type="submit" class="primary-btn">Save Custom Code</button>
            </div>
        </form>
    </div>
@endsection
