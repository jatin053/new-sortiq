{{-- Contributions by mrabhi2k3 (https://github.com/mrabhi2k3) --}}
<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $versionedAdminCss = is_file(public_path('css/admin.css'))
            ? asset('css/admin.css') . '?v=' . filemtime(public_path('css/admin.css'))
            : asset('css/admin.css');
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | Sortiq Solutions Admin</title>
    @include('admin.partials.favicon-links')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ $versionedAdminCss }}">
</head>
<body class="auth-page">
    <div class="auth-shell">
        <div class="auth-card">
            <div class="auth-brand">
                <img
                    src="{{ asset('frontend-assets/media/admin-use.png') }}"
                    alt="Sortiq Solutions"
                    width="185"
                    height="77"
                    class="auth-logo"
                >
                <span class="auth-eyebrow">Admin Panel</span>
                <h1>Sign in to the admin panel</h1>
                <p>Use your admin email and password to open the Sortiq dashboard.</p>
            </div>

            @if ($errors->any())
                <div class="auth-error-box">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="post" action="{{ route('admin.authenticate') }}" class="auth-form">
                @csrf

                <label>
                    <span>Email Address</span>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter admin email"
                        required
                        autofocus
                    >
                </label>

                <label>
                    <span>Password</span>
                    <input
                        type="password"
                        name="password"
                        placeholder="Enter password"
                        required
                    >
                </label>

                <label class="auth-checkbox">
                    <input type="checkbox" name="remember" value="1">
                    <span>Keep me signed in</span>
                </label>

                <button type="submit" class="primary-btn auth-submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
