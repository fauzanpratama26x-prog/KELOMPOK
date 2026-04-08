<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Toko Indonesia - Tambah Supplier</title>

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
        main { flex: 1 0 auto; width: 100%; }
        footer { flex-shrink: 0; width: 100%; }

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

        .nav-active {
            border-bottom-color: var(--green-600) !important;
            color: var(--green-700) !important;
        }
        .dark .nav-active {
            border-bottom-color: var(--green-400) !important;
            color: var(--green-400) !important;
        }
        .nav-link {
            color: #6b7280;
            transition: color 0.15s, border-color 0.15s;
        }
        .nav-link:hover { color: var(--green-700); border-bottom-color: var(--green-300) !important; }
        .dark .nav-link { color: #9ca3af; }
        .dark .nav-link:hover { color: var(--green-400); border-bottom-color: var(--green-700) !important; }

        .user-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            border: 1px solid var(--green-200);
            border-radius: 0.5rem;
            font-size: 0.875rem;
            color: #374151;
            background: #fff;
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s;
        }
        .user-btn:hover { background: var(--green-50); border-color: var(--green-300); }
        .dark .user-btn {
            background: #0d1f12;
            border-color: rgba(74, 222, 128, 0.15);
            color: #d1fae5;
        }
        .dark .user-btn:hover { background: rgba(22, 101, 52, 0.15); }

        .dropdown-menu {
            background: #ffffff;
            border: 1px solid var(--green-100);
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.08);
        }
        .dark .dropdown-menu {
            background: #0d1f12;
            border-color: rgba(74, 222, 128, 0.1);
        }
        .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.5rem 1rem;
            text-align: left;
            font-size: 0.875rem;
            color: #374151;
            transition: background 0.15s;
        }
        .dropdown-item:hover { background: var(--green-50); color: var(--green-800); }
        .dark .dropdown-item { color: #d1fae5; }
        .dark .dropdown-item:hover { background: rgba(22, 101, 52, 0.15); }

        .page-header {
            background: #ffffff;
            border-bottom: 1px solid var(--green-100);
        }
        .dark .page-header {
            background: #0d1f12;
            border-bottom: 1px solid rgba(74, 222, 128, 0.06);
        }
        .header-label {
            color: var(--green-600);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }
        .dark .header-label { color: var(--green-500); }

        .btn-back {
            display: inline-flex;
            align-items: center;
            padding: 0.45rem 0.875rem;
            background: var(--green-50);
            color: var(--green-800);
            border: 1px solid var(--green-200);
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background 0.15s;
        }
        .btn-back:hover { background: var(--green-100); }
        .dark .btn-back {
            background: rgba(22, 101, 52, 0.15);
            color: var(--green-400);
            border-color: rgba(74, 222, 128, 0.15);
        }
        .dark .btn-back:hover { background: rgba(22, 101, 52, 0.25); }

        .form-card {
            background: #ffffff;
            border: 1px solid var(--green-100);
            border-radius: 0.875rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(22, 163, 74, 0.06);
        }
        .dark .form-card {
            background: #0d1f12;
            border-color: rgba(74, 222, 128, 0.08);
        }

        .card-accent {
            height: 3px;
            background: linear-gradient(to right, var(--green-400), var(--green-600));
        }

        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.375rem;
        }
        .dark .form-label { color: #d1fae5; }

        .form-hint {
            margin-top: 0.25rem;
            font-size: 0.7rem;
            color: #9ca3af;
        }
        .dark .form-hint { color: #6b7280; }

        .form-input, .form-select, .form-textarea {
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
        .form-input::placeholder, .form-textarea::placeholder { color: #9ca3af; }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: var(--green-500);
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.12);
        }
        .dark .form-input, .dark .form-select, .dark .form-textarea {
            background: #0a1a0f;
            border-color: rgba(74, 222, 128, 0.15);
            color: #d1fae5;
        }
        .dark .form-input::placeholder, .dark .form-textarea::placeholder { color: #4b5563; }
        .dark .form-input:focus, .dark .form-select:focus, .dark .form-textarea:focus {
            border-color: var(--green-500);
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.1);
        }
        .form-textarea { resize: vertical; }

        .field-error {
            margin-top: 0.25rem;
            font-size: 0.75rem;
            color: #dc2626;
        }
        .dark .field-error { color: #f87171; }

        .btn-cancel {
            padding: 0.55rem 1rem;
            background: var(--green-50);
            color: var(--green-800);
            border: 1px solid var(--green-200);
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background 0.15s;
        }
        .btn-cancel:hover { background: var(--green-100); }
        .dark .btn-cancel {
            background: rgba(22, 101, 52, 0.15);
            color: var(--green-400);
            border-color: rgba(74, 222, 128, 0.15);
        }

        .btn-submit {
            padding: 0.55rem 1.25rem;
            background: var(--green-700);
            color: #ffffff;
            border: none;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-submit:hover { background: var(--green-800); }
        .dark .btn-submit { background: var(--green-600); }
        .dark .btn-submit:hover { background: var(--green-500); }

        .site-footer {
            background: #ffffff;
            border-top: 1px solid var(--green-100);
        }
        .dark .site-footer {
            background: #0d1f12;
            border-color: rgba(74, 222, 128, 0.06);
        }
    </style>
</head>
<body class="antialiased">

    <nav class="navbar fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center gap-2">
                        <div style="width:26px;height:26px;background:var(--green-600);border-radius:6px;display:flex;align-items:center;justify-content:center;">
                            <svg width="14" height="14" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                        </div>
                        <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-900 dark:text-white tracking-tight">
                            TOKO <span class="logo-accent font-light">INDONESIA</span>
                        </a>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        @auth
                        <a href="{{ route('admin.barang.index') }}" 
                           class="nav-link inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium transition">
                            Barang
                        </a>
                        <a href="{{ route('admin.suplier.index') }}" 
                           class="nav-active nav-link inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium transition">
                            Supplier
                        </a>
                        @endauth
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="user-btn">
                                <div>{{ Auth::user()->name }}</div>
                                <svg class="ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" 
                                 class="dropdown-menu absolute right-0 mt-2 w-48 py-1 z-50">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <header class="page-header pt-20">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <span class="header-label">ADMIN</span>
                    <h2 class="text-2xl font-light text-gray-900 dark:text-white mt-1">
                        Tambah Supplier Baru
                    </h2>
                </div>
                <a href="{{ route('admin.suplier.index') }}" class="btn-back">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </header>

    <main class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="form-card">
                <div class="card-accent"></div>
                <div class="p-8">
                    <form method="POST" action="{{ route('admin.suplier.store') }}">
                        @csrf

                        <div class="space-y-6">
                            <div>
                                <label for="id_suplier" class="form-label">ID Supplier</label>
                                <input type="text" 
                                       name="id_suplier" 
                                       id="id_suplier" 
                                       value="{{ old('id_suplier') }}"
                                       class="form-input"
                                       placeholder="Contoh: SP04"
                                       required>
                                @error('id_suplier')
                                    <p class="field-error">{{ $message }}</p>
                                @enderror
                                <p class="form-hint">Format: SP + 2 digit angka</p>
                            </div>

                            <div>
                                <label for="nama" class="form-label">Nama Supplier</label>
                                <input type="text" 
                                       name="nama" 
                                       id="nama" 
                                       value="{{ old('nama') }}"
                                       class="form-input"
                                       required>
                                @error('nama')
                                    <p class="field-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" 
                                          id="alamat" 
                                          rows="3"
                                          class="form-textarea"
                                          required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <p class="field-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="kota" class="form-label">Kota</label>
                                    <input type="text" 
                                           name="kota" 
                                           id="kota" 
                                           value="{{ old('kota') }}"
                                           class="form-input"
                                           required>
                                    @error('kota')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="telepon" class="form-label">Telepon</label>
                                    <input type="text" 
                                           name="telepon" 
                                           id="telepon" 
                                           value="{{ old('telepon') }}"
                                           class="form-input"
                                           required>
                                    @error('telepon')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex items-center justify-end space-x-3 pt-4">
                                <a href="{{ route('admin.suplier.index') }}" class="btn-cancel">Batal</a>
                                <button type="submit" class="btn-submit">Simpan Supplier</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="site-footer py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-center gap-2">
            <div style="width:14px;height:14px;background:var(--green-600);border-radius:3px;display:inline-flex;align-items:center;justify-content:center;">
                <svg width="8" height="8" fill="none" stroke="#fff" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5"/>
                </svg>
            </div>
            <p class="text-xs text-gray-400">© 2026 Toko Indonesia · Sistem Pergudangan</p>
        </div>
    </footer>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>