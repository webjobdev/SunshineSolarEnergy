<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="adminHMD authentication page">
    <title>{{ configSetting('web_name') }} | Login</title>
    <link rel="icon" type="image/x-icon" href="{{ configImage('web_favicon') ?? asset('admin-theme/assets/images/brand/logo/logo-icon.svg') }}">
    <link rel="stylesheet" href="{{ asset('admin-theme/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-theme/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-theme/assets/css/style.css') }}">
</head>

<body class="auth-body">
    <button class="icon-button theme-toggle auth-theme-toggle" type="button" data-theme-toggle
        aria-label="Switch color theme" title="Switch color theme">
        <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
    </button>
    <main class="auth-page">
        <section class="auth-card">
            <a class="auth-brand" href="{{ route('admin.login') }}">
                <span class="brand-icon">
                    {{-- <i class="bi bi-grid-1x2-fill" aria-hidden="true"></i> --}}
                    <img src="{{ configImage('web_logo') ?? asset('admin-theme/assets/images/brand/logo/logo-icon.svg') }}" alt="Logo" class="img-fluid">
                </span><span>
                    <h1>{{ configSetting('web_name') }}</h1>
                    {{-- <strong>Admin Panel</strong> --}}
                </span>
            </a>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any() && !$errors->has('email') && !$errors->has('password'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <form class="needs-validation" method="POST" action="{{ route('admin.login.authenticate') }}" novalidate>
                @csrf
                <div class="mb-4">
                    <h1 class="h3 mb-1">Login</h1>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="loginEmail">Email address</label>
                    <input class="form-control @error('email') is-invalid @enderror" id="loginEmail" name="email"
                        type="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback">Enter a valid email.</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="loginPassword">Password</label>
                    </div>
                    <input class="form-control @error('password') is-invalid @enderror" id="loginPassword"
                        name="password" type="password" minlength="6" required>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback">Password must be at least 6 characters.</div>
                    @enderror
                </div>
                <button class="btn btn-primary w-100" type="submit">
                    <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i>Login
                </button>
            </form>
        </section>
    </main>

    <script src="{{ asset('admin-theme/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-theme/assets/js/main.js') }}"></script>
    <script>
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach((form) => {
                form.addEventListener('submit', (event) => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>

</html>
