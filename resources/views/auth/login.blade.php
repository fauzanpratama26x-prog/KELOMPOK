<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Toko Indonesia - Login</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --green-50:  #f0fdf4;
            --green-100: #dcfce7;
            --green-200: #bbf7d0;
            --green-300: #86efac;
            --green-400: #4ade80;
            --green-500: #22c55e;
            --green-600: #16a34a;
            --green-700: #15803d;
            --green-800: #166534;
        }

        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: var(--green-50);
        }
        .dark body { background-color: #030f07; }

        main {
            flex: 1 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--green-100);
        }
        .dark .navbar {
            background: rgba(10, 30, 18, 0.92);
            border-bottom: 1px solid rgba(74, 222, 128, 0.08);
        }

        .logo-accent { color: var(--green-600); }

        .nav-register {
            font-size: 0.875rem;
            color: #6b7280;
            transition: color 0.15s;
        }
        .nav-register:hover { color: var(--green-700); }
        .dark .nav-register { color: #9ca3af; }
        .dark .nav-register:hover { color: var(--green-400); }

        /* Card */
        .card {
            background: #ffffff;
            border: 1px solid var(--green-100);
            border-radius: 0.875rem;
            padding: 2rem;
            width: 100%;
            max-width: 22rem;
            box-shadow: 0 4px 16px rgba(22, 163, 74, 0.07);
        }
        .dark .card {
            background: #0d1f12;
            border-color: rgba(74, 222, 128, 0.08);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
        }

        .card-accent {
            height: 3px;
            background: linear-gradient(to right, var(--green-400), var(--green-600));
            border-radius: 9999px;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 300;
            color: #111827;
            margin-bottom: 1.5rem;
        }
        .dark .card-title { color: #f0fdf4; }

        /* Status alert */
        .alert-status {
            margin-bottom: 1rem;
            background: var(--green-50);
            border: 1px solid var(--green-200);
            color: var(--green-800);
            padding: 0.5rem 0.75rem;
            font-size: 0.8rem;
            border-radius: 0.5rem;
        }
        .dark .alert-status {
            background: rgba(22, 101, 52, 0.15);
            border-color: rgba(74, 222, 128, 0.15);
            color: var(--green-300);
        }

        /* Inputs */
        .form-input {
            width: 100%;
            padding: 0.55rem 0.75rem;
            font-size: 0.875rem;
            border: 1px solid var(--green-200);
            border-radius: 0.5rem;
            background: #ffffff;
            color: #111827;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-sizing: border-box;
        }
        .form-input::placeholder { color: #9ca3af; }
        .form-input:focus {
            border-color: var(--green-500);
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.12);
        }
        .dark .form-input {
            background: #0a1a0f;
            border-color: rgba(74, 222, 128, 0.15);
            color: #d1fae5;
        }
        .dark .form-input::placeholder { color: #4b5563; }
        .dark .form-input:focus {
            border-color: var(--green-500);
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.1);
        }

        /* Checkbox */
        .form-checkbox {
            width: 14px;
            height: 14px;
            border: 1px solid var(--green-300);
            border-radius: 3px;
            accent-color: var(--green-600);
            cursor: pointer;
        }

        /* Error */
        .field-error {
            margin-top: 0.25rem;
            font-size: 0.7rem;
            color: #dc2626;
        }
        .dark .field-error { color: #f87171; }

        /* Remember / Forgot row */
        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .remember-label {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.75rem;
            color: #6b7280;
            cursor: pointer;
        }
        .dark .remember-label { color: #9ca3af; }

        .forgot-link {
            font-size: 0.75rem;
            color: var(--green-600);
            transition: color 0.15s;
        }
        .forgot-link:hover { color: var(--green-800); }
        .dark .forgot-link { color: var(--green-400); }
        .dark .forgot-link:hover { color: var(--green-300); }

        /* Submit button */
        .btn-submit {
            width: 100%;
            padding: 0.6rem 1rem;
            background: var(--green-700);
            color: #ffffff;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-submit:hover { background: var(--green-800); }
        .dark .btn-submit { background: var(--green-600); }
        .dark .btn-submit:hover { background: var(--green-500); }

        /* Footer */
        .site-footer {
            background: #ffffff;
            border-top: 1px solid var(--green-100);
            padding: 1.1rem 0;
        }
        .dark .site-footer {
            background: #0d1f12;
            border-color: rgba(74, 222, 128, 0.06);
        }
    </style>
</head>
<body class="antialiased">

    <!-- Navbar -->
    <nav class="navbar w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-2">
                    <div style="width:26px;height:26px;background:var(--green-600);border-radius:6px;display:flex;align-items:center;justify-content:center;">
                        <svg width="14" height="14" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                    </div>
                    <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-900 dark:text-white tracking-tight">
                        TOKO <span class="logo-accent font-light">INDONESIA</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('register') }}" class="nav-register">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="card">
            <div class="card-accent"></div>
            <h2 class="card-title">Login</h2>

            @if (session('status'))
                <div class="alert-status">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div style="display:flex; flex-direction:column; gap:0.875rem;">
                    <div>
                        <input id="email" type="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="Email"
                               required autofocus
                               class="form-input">
                        @error('email')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <input id="password" type="password" name="password"
                               placeholder="Password"
                               required
                               class="form-input">
                        @error('password')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- <div class="remember-row">
                        <label class="remember-label">
                            <input type="checkbox" name="remember" class="form-checkbox">
                            Ingat saya
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                        @endif
                    </div>
--}}
                    <button type="submit" class="btn-submit" style="margin-top:0.25rem;">
                        Login
                    </button>
                </div>
            </form>

        </div>
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-center gap-2">
            <div style="width:14px;height:14px;background:var(--green-600);border-radius:3px;display:inline-flex;align-items:center;justify-content:center;">
                <svg width="8" height="8" fill="none" stroke="#fff" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5"/>
                </svg>
            </div>
            <p class="text-xs text-gray-400">© 2026 Toko Indonesia · Sistem Pergudangan</p>
        </div>
    </footer>

</body>
</html>