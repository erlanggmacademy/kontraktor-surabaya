<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Kontraktor Surabaya</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #0D1B35;
            --gold: #F5A623;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--navy) 0%, #162444 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.3);
        }
        .login-brand {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--navy);
            margin-bottom: 0.25rem;
        }
        .login-brand span { color: var(--gold); }
        .form-control:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 0.2rem rgba(245,166,35,0.2);
        }
        .btn-login {
            background: var(--navy);
            color: #fff;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            padding: 0.75rem;
            border-radius: 10px;
            border: none;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background: var(--gold);
            color: var(--navy);
        }
    </style>
</head>
<body>
    <div class="login-card">
        {{-- Brand --}}
        <div class="text-center mb-4">
            <div class="login-brand"><span>KS</span> Admin Panel</div>
            <p class="text-muted small mb-0">Masuk untuk mengelola website</p>
        </div>

        {{-- Session Status --}}
        @if (session('status'))
            <div class="alert alert-success alert-sm mb-3">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold small">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required autofocus autocomplete="username"
                       placeholder="admin@email.com">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <label for="password" class="form-label fw-semibold small">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="small text-muted">Lupa password?</a>
                    @endif
                </div>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       required autocomplete="current-password" placeholder="••••••••">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                <label class="form-check-label small text-muted" for="remember_me">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-login w-100">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="text-muted small text-decoration-none">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Website
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
