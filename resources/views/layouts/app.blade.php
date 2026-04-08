<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 items-center justify-between">
                        <div class="flex items-center gap-4">
                            <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-900">{{ config('app.name', 'Laravel') }}</a>
                            @auth
                                <x-nav-link :href="route('gudang.index')" :active="request()->routeIs('gudang.index')">
                                    {{ __('Gudang') }}
                                </x-nav-link>
                                <x-nav-link :href="route('gerai.index')" :active="request()->routeIs('gerai.index')">
                                    {{ __('Gerai') }}
                                </x-nav-link>
                                @if(Auth::user()->role === 'admin')
                                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                        {{ __('Admin') }}
                                    </x-nav-link>
                                @endif
                            @endauth
                        </div>
                        <div class="flex items-center gap-4">
                            @auth
                                <span class="text-sm text-gray-700">{{ auth()->user()->name }}</span>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-sm text-gray-700 hover:text-gray-900">{{ __('Logout') }}</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-gray-900">{{ __('Login') }}</a>
                                <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:text-gray-900">{{ __('Register') }}</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <main class="py-10">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </body>
</html>
