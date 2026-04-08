<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Toko Indonesia - Register</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --green-50:  
            --green-100: 
            --green-200: 
            --green-300: 
            --green-400: 
            --green-500: 
            --green-600: 
            --green-700: 
            --green-800: 
        }

        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: var(--green-50);
        }
        .dark body { background-color: 

        main {
            flex: 1 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        
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

        .nav-login {
            font-size: 0.875rem;
            color: 
            transition: color 0.15s;
        }
        .nav-login:hover { color: var(--green-700); }
        .dark .nav-login { color: 
        .dark .nav-login:hover { color: var(--green-400); }

        
        .card {
            background: 
            border: 1px solid var(--green-100);
            border-radius: 0.875rem;
            padding: 2rem;
            width: 100%;
            max-width: 22rem;
            box-shadow: 0 4px 16px rgba(22, 163, 74, 0.07);
        }
        .dark .card {
            background: 
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
            color: 
            margin-bottom: 1.5rem;
        }
        .dark .card-title { color: 

        
        .form-input {
            width: 100%;
            padding: 0.55rem 0.75rem;
            font-size: 0.875rem;
            border: 1px solid var(--green-200);
            border-radius: 0.5rem;
            background: 
            color: 
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-sizing: border-box;
        }
        .form-input::placeholder { color: 
        .form-input:focus {
            border-color: var(--green-500);
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.12);
        }
        .dark .form-input {
            background: 
            border-color: rgba(74, 222, 128, 0.15);
            color: 
        }
        .dark .form-input::placeholder { color: 
        .dark .form-input:focus {
            border-color: var(--green-500);
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.1);
        }

        
        .field-error {
            margin-top: 0.25rem;
            font-size: 0.7rem;
            color: 
        }
        .dark .field-error { color: 

        
        .btn-submit {
            width: 100%;
            padding: 0.6rem 1rem;
            background: var(--green-700);
            color: 
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

        
        .site-footer {
            background: 
            border-top: 1px solid var(--green-100);
            padding: 1.1rem 0;
        }
        .dark .site-footer {
            background: 
            border-color: rgba(74, 222, 128, 0.06);
        }
    </style>
</head>
<body class="antialiased">

    
    <nav class="navbar w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-2">
                    <div style="width:26px;height:26px;background:var(--green-600);border-radius:6px;display:flex;align-items:center;justify-content:center;">
                        <svg width="14" height="14" fill="none" stroke="
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                    </div>
                    <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-900 dark:text-white tracking-tight">
                        TOKO <span class="logo-accent font-light">INDONESIA</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('login') }}" class="nav-login">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="card">
            <div class="card-accent"></div>
            <h2 class="card-title">Buat Akun Baru</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div style="display:flex; flex-direction:column; gap:0.875rem;">
                    <div>
                        <input id="name" type="text" name="name"
                               value="{{ old('name') }}"
                               placeholder="Nama lengkap"
                               required autofocus
                               class="form-input">
                        @error('name')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <input id="email" type="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="Email"
                               required
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

                    <div>
                        <input id="password_confirmation" type="password"
                               name="password_confirmation"
                               placeholder="Konfirmasi password"
                               required
                               class="form-input">
                    </div>

                    <div>
                        <select id="role" name="role" required class="form-input" style="background-color: 
                            <option value="">-- Pilih Role --</option>
                            <option value="gerai" {{ old('role') === 'gerai' ? 'selected' : '' }}>Gerai (Penjual)</option>
                            <option value="gudang" {{ old('role') === 'gudang' ? 'selected' : '' }}>Gudang (Pengelola Stok)</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin (Approver)</option>
                        </select>
                        @error('role')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit" style="margin-top:0.25rem;">
                        Daftar
                    </button>
                </div>
            </form>

            <p style="text-align:center; font-size:0.75rem; color:
                Sudah punya akun?
                <a href="{{ route('login') }}" style="color:var(--green-600); font-weight:500;">Login di sini</a>
            </p>
        </div>
    </main>

    
    <footer class="site-footer">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-center gap-2">
            <div style="width:14px;height:14px;background:var(--green-600);border-radius:3px;display:inline-flex;align-items:center;justify-content:center;">
                <svg width="8" height="8" fill="none" stroke="
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5"/>
                </svg>
            </div>
            <p class="text-xs text-gray-400">© 2026 Toko Indonesia · Sistem Pergudangan</p>
        </div>
    </footer>

</body>
</html>