@php
    $faviconVersion = $faviconVersion ?? '20260420b';
    $faviconPngUrl = url('/frontend-assets/media/admin-tab-mark.png') . '?v=' . $faviconVersion;
@endphp

<link rel="icon" type="image/png" sizes="32x32" href="{{ $faviconPngUrl }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ $faviconPngUrl }}">
<link rel="shortcut icon" href="{{ $faviconPngUrl }}">
<link rel="apple-touch-icon" href="{{ $faviconPngUrl }}">
