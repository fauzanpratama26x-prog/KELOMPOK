<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Toko Indonesia - Sistem Pergudangan</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-900 antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto max-w-6xl px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="h-8 w-8 rounded-lg bg-emerald-600"></div>
                        <span class="text-lg font-semibold">Toko Indonesia</span>
                    </div>
                    <nav class="flex items-center gap-6 text-sm text-slate-600">
                        @auth
                            <a href="{{ route('dashboard') }}" class="font-medium text-emerald-700 hover:text-emerald-800">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="font-medium text-emerald-700 hover:text-emerald-800">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="font-medium text-emerald-700 hover:text-emerald-800">Login</a>
                        @endauth
                    </nav>
                </div>
            </div>
        </header>

        <!-- Main -->
        <main class="flex flex-1 flex-col items-center justify-center px-6 py-20">
            <div class="max-w-3xl text-center">
                <div class="mb-8 inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-emerald-100">
                    <svg class="h-12 w-12 text-emerald-700" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                    </svg>
                </div>

                <h1 class="mb-4 text-5xl font-bold text-slate-900">Sistem Pergudangan Toko Indonesia</h1>
                <p class="mb-12 text-xl text-slate-600 leading-relaxed">Kelola stok barang, supplier, dan permintaan dengan mudah. Single platform untuk admin, gudang, dan gerai dengan antarmuka yang bersih dan efisien.</p>

                <div class="grid gap-6 sm:grid-cols-3 mb-12">
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-semibold text-slate-900">Manajemen Barang</p>
                        <p class="mt-2 text-xs text-slate-600">Kelola inventori dengan mudah</p>
                    </div>
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-semibold text-slate-900">Data Supplier</p>
                        <p class="mt-2 text-xs text-slate-600">Informasi lengkap dalam satu tempat</p>
                    </div>
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-semibold text-slate-900">Monitoring Real-time</p>
                        <p class="mt-2 text-xs text-slate-600">Pantau stok secara akurat</p>
                    </div>
                </div>

                @auth
                    <a href="{{ route('dashboard') }}" class="inline-block rounded-lg bg-emerald-700 px-8 py-3 font-semibold text-white shadow-sm hover:bg-emerald-800">Buka Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="inline-block rounded-lg bg-emerald-700 px-8 py-3 font-semibold text-white shadow-sm hover:bg-emerald-800">Masuk Sekarang</a>
                @endauth
            </div>
        </main>

        <!-- Footer -->
        <footer class="border-t border-slate-200 bg-slate-50 py-6">
            <div class="mx-auto max-w-6xl px-6 text-center text-sm text-slate-500">
                © 2026 Toko Indonesia · Sistem Pergudangan
            </div>
        </footer>
    </div>
</body>
</html>
