@extends('admin.layouts.app')

@section('title', 'Live Robots.txt File Editor')

@section('content')
    @if (session('status'))
        <div style="margin-bottom: 20px; padding: 14px 18px; background: #e6f4ea; color: #137333; border-radius: 8px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            {{ session('status') }}
        </div>
    @endif

    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 32px 36px; box-shadow: 0 1px 3px rgba(0,0,0,0.03); max-width: 1200px; margin: 0 auto 40px;">
        <div style="margin-bottom: 24px;">
            <h2 style="font-size: 20px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">
                Live Robots.txt File Editor
            </h2>
            <p style="color: #64748b; font-size: 13.5px; margin: 0; line-height: 1.5;">
                Edit lines directly. Changes take effect immediately at <a href="{{ route('robots') }}" target="_blank" style="color: #64748b; text-decoration: underline;">{{ url('/robots.txt') }}</a>.
            </p>
        </div>

        <form action="{{ route('admin.robots-settings.update') }}" method="post" novalidate>
            @csrf
            @method('PUT')

            <div style="margin-bottom: 24px;">
                <textarea 
                    name="content" 
                    id="robots_content"
                    rows="16"
                    spellcheck="false"
                    placeholder="User-agent: *&#10;Disallow: /admin/&#10;Allow: /"
                    style="width: 100%; min-height: 340px; padding: 18px 20px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-family: 'Courier New', Courier, monospace, monospace; font-size: 14px; line-height: 1.6; color: #1e293b; background: #ffffff; resize: vertical; box-sizing: border-box; transition: border-color 0.15s;"
                    onfocus="this.style.borderColor='#ff6600';"
                    onblur="this.style.borderColor='#cbd5e1';"
                >{{ old('content', $content) }}</textarea>
                
                @error('content')
                    <span style="color: #dc2626; font-size: 13px; margin-top: 6px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
                <button 
                    type="submit" 
                    style="background: #ff6600; color: #ffffff; border: none; padding: 12px 28px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: background 0.15s; display: inline-flex; align-items: center; gap: 6px;"
                    onmouseover="this.style.background='#e65c00';"
                    onmouseout="this.style.background='#ff6600';"
                >
                    Save Robots.txt
                </button>

                <a 
                    href="{{ route('robots') }}" 
                    target="_blank" 
                    style="color: #334155; font-size: 14px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; transition: color 0.15s;"
                    onmouseover="this.style.color='#ff6600';"
                    onmouseout="this.style.color='#334155';"
                >
                    Open Live File <span style="font-size: 15px;">&#8599;</span>
                </a>

                <button 
                    type="button" 
                    onclick="if(confirm('Reset robots.txt to recommended SEO and AI crawler defaults?')) { document.getElementById('reset-robots-form').submit(); }"
                    style="margin-left: auto; background: none; border: none; color: #94a3b8; font-size: 13px; cursor: pointer; text-decoration: underline;"
                    onmouseover="this.style.color='#64748b';"
                    onmouseout="this.style.color='#94a3b8';"
                >
                    Reset to Recommended Defaults
                </button>
            </div>
        </form>

        <form id="reset-robots-form" action="{{ route('admin.robots-settings.reset') }}" method="post" style="display: none;">
            @csrf
        </form>
    </div>
@endsection
