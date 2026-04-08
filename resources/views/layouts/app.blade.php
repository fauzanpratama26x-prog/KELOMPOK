<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-white">
        <div class="min-h-screen flex flex-col">
            <nav class="border-b border-slate-200 bg-white">
                <div class="mx-auto max-w-6xl px-6 py-4">
                    <div class="flex items-center justify-between">
                        <a href="{{ url('/') }}" class="flex items-center gap-2">
                            <div class="h-8 w-8 rounded-lg bg-emerald-600"></div>
                            <span class="text-lg font-semibold text-slate-900">{{ config('app.name', 'Toko Indonesia') }}</span>
                        </a>
                        @auth
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm font-medium text-emerald-700 hover:text-emerald-800">Logout</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </nav>

            <main class="flex-1 px-6 py-10">
                <div class="mx-auto max-w-6xl">
                    @yield('content')
                </div>
            </main>

            <footer class="border-t border-slate-200 bg-slate-50 py-6 mt-auto">
                <div class="mx-auto max-w-6xl px-6 text-center text-sm text-slate-500">
                    © 2026 Toko Indonesia · Sistem Pergudangan
                </div>
            </footer>
        </div>
    </body>
</html>
