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
</head>
<body class="antialiased bg-emerald-50 text-slate-900">
    <div class="min-h-screen flex flex-col">
        <nav class="bg-white border-b border-slate-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <a href="{{ url('/') }}" class="flex items-center gap-3 text-slate-900">
                    <div class="h-10 w-10 rounded-2xl bg-emerald-600"></div>
                    <div>
                        <p class="font-semibold">Toko Indonesia</p>
                        <p class="text-xs text-slate-500">Sistem Pergudangan</p>
                    </div>
                </a>
                <div class="flex items-center gap-4 text-sm">
                    <a href="{{ url('/') }}" class="text-slate-600 hover:text-slate-900">Beranda</a>
                    <a href="{{ route('register') }}" class="rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700 hover:bg-emerald-100">Register</a>
                </div>
            </div>
        </nav>

        <main class="flex flex-1 items-center justify-center px-6 py-12">
            <div class="w-full max-w-md rounded-[2rem] bg-white border border-slate-200 p-8 shadow-lg">
                <div class="mb-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-emerald-700">Login</p>
                    <h1 class="mt-3 text-3xl font-semibold text-slate-900">Masuk ke Toko Indonesia</h1>
                    <p class="mt-2 text-sm text-slate-600">Masukkan email dan password Anda untuk masuk ke sistem.</p>
                </div>

                @if (session('status'))
                    <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" placeholder="name@example.com">
                        @error('email')
                            <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                        <input id="password" type="password" name="password" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" placeholder="••••••••">
                        @error('password')
                            <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full rounded-3xl bg-emerald-700 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-800">Login</button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-500">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-emerald-700 hover:text-emerald-800">Daftar sekarang</a></p>
            </div>
        </main>

        <footer class="bg-slate-100 border-t border-slate-200 py-4">
            <div class="max-w-7xl mx-auto px-6 text-center text-xs text-slate-500">© 2026 Toko Indonesia · Sistem Pergudangan</div>
        </footer>
    </div>
</body>
</html>
