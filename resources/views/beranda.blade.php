<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Toko Indonesia - Sistem Pergudangan</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --green-50:  #f0fdf4;
            --green-100: #dcfce7;
            --green-200: #bbf7d0;
            --green-400: #4ade80;
            --green-500: #22c55e;
            --green-600: #16a34a;
            --green-700: #15803d;
            --green-800: #166534;
            --green-900: #14532d;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #1a1a1a;
        }

        /* Glass Navbar */
        .glass-effect {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--green-100);
        }
        .dark .glass-effect {
            background: rgba(10, 30, 18, 0.92);
            border-bottom: 1px solid rgba(74, 222, 128, 0.08);
        }

        /* Card shadow */
        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.06), 0 2px 4px -1px rgba(22, 163, 74, 0.03);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-shadow:hover {
            box-shadow: 0 20px 25px -5px rgba(22, 163, 74, 0.1), 0 10px 10px -5px rgba(22, 163, 74, 0.04);
            transform: translateY(-4px);
        }

        /* Gradient border card */
        .gradient-border {
            position: relative;
            background: #ffffff;
            border-radius: 1rem;
            border: 1px solid var(--green-100);
            z-index: 1;
            transition: border-color 0.3s ease;
        }
        .dark .gradient-border {
            background: #0d2018;
            border-color: rgba(74, 222, 128, 0.1);
        }
        .gradient-border:hover {
            border-color: var(--green-400);
        }

        /* Feature card */
        .feature-card {
            transition: all 0.3s ease;
            border-left: 2px solid transparent;
        }
        .feature-card:hover {
            border-left-color: var(--green-500);
            background: linear-gradient(to right, rgba(74, 222, 128, 0.05), transparent);
            transform: translateX(4px);
        }

        /* Pill badge */
        .badge-green {
            background: var(--green-50);
            color: var(--green-700);
            border: 1px solid var(--green-200);
        }
        .dark .badge-green {
            background: rgba(22, 101, 52, 0.3);
            color: var(--green-400);
            border-color: rgba(74, 222, 128, 0.2);
        }

        /* Section dot number */
        .section-num {
            color: var(--green-200);
        }
        .dark .section-num {
            color: rgba(74, 222, 128, 0.15);
        }

        /* Divider line */
        .divider-green {
            background: linear-gradient(to right, transparent, var(--green-400), transparent);
            height: 1px;
            border: none;
        }

        /* Smooth scroll */
        html { scroll-behavior: smooth; }

        /* Section bg subtle */
        .section-alt {
            background: var(--green-50);
            border-top: 1px solid var(--green-100);
            border-bottom: 1px solid var(--green-100);
        }
        .dark .section-alt {
            background: rgba(10, 30, 18, 0.5);
            border-color: rgba(74, 222, 128, 0.06);
        }

        /* Nav underline accent */
        .nav-underline span {
            background-color: var(--green-500);
        }

        /* Primary button */
        .btn-primary {
            background: var(--green-700);
            color: #ffffff;
        }
        .btn-primary:hover {
            background: var(--green-800);
        }
        .dark .btn-primary {
            background: var(--green-500);
            color: #0a1a0f;
        }
        .dark .btn-primary:hover {
            background: var(--green-400);
        }

        /* Secondary button */
        .btn-secondary {
            border: 1px solid var(--green-200);
            color: var(--green-800);
            background: transparent;
        }
        .btn-secondary:hover {
            background: var(--green-50);
            border-color: var(--green-400);
        }
        .dark .btn-secondary {
            border-color: rgba(74, 222, 128, 0.2);
            color: var(--green-400);
        }
        .dark .btn-secondary:hover {
            background: rgba(74, 222, 128, 0.05);
        }

        /* Icon box */
        .icon-box {
            background: var(--green-50);
        }
        .dark .icon-box {
            background: rgba(22, 101, 52, 0.2);
        }
        .icon-box svg {
            color: var(--green-700);
        }
        .dark .icon-box svg {
            color: var(--green-400);
        }

        /* Footer border */
        footer {
            border-top: 1px solid var(--green-100);
        }
        .dark footer {
            border-color: rgba(74, 222, 128, 0.06);
        }

        /* Text secondary */
        .text-muted {
            color: #6b7280;
        }
        .dark .text-muted {
            color: #6b7280;
        }

        /* Hero dot pattern */
        .hero-pattern {
            background-image: radial-gradient(circle, var(--green-200) 1px, transparent 0);
            background-size: 40px 40px;
        }
        .dark .hero-pattern {
            background-image: radial-gradient(circle, rgba(74, 222, 128, 0.12) 1px, transparent 0);
        }
    </style>
</head>
<body class="antialiased bg-white dark:bg-gray-950">

    <!-- Navbar -->
    <nav class="glass-effect fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div style="width:28px;height:28px;background:var(--green-600);border-radius:6px;display:flex;align-items:center;justify-content:center;">
                        <svg width="16" height="16" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    </div>
                    <span class="text-xl font-semibold tracking-tight">
                        <span class="text-gray-900 dark:text-white">TOKO</span>
                        <span class="ml-1 font-light" style="color:var(--green-600)">INDONESIA</span>
                    </span>
                </div>
                
                <!-- Navigation -->
                <div class="flex items-center space-x-8">
                    <a href="#tentang" 
                       class="nav-underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition relative group py-2">
                        Tentang
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#fitur" 
                       class="nav-underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition relative group py-2">
                        Fitur
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 transition-all group-hover:w-full"></span>
                    </a>
                    
                    @auth
                        <a href="{{ route('admin.dashboard') }}" 
                           class="btn-primary text-sm px-5 py-2 rounded-lg transition shadow-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="btn-primary text-sm px-5 py-2 rounded-lg transition shadow-sm">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-40 pb-24 px-6 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.035]">
            <div class="absolute inset-0 hero-pattern"></div>
        </div>
        <!-- Subtle green glow top center -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-96 h-64 rounded-full opacity-10"
             style="background: radial-gradient(ellipse, var(--green-400), transparent 70%); pointer-events:none;"></div>
        
        <div class="max-w-4xl mx-auto text-center relative">
            <div class="inline-block mb-8">
                <span class="badge-green text-xs font-medium tracking-[0.2em] px-5 py-2 rounded-full uppercase">
                    Sistem Manajemen Inventori
                </span>
            </div>
            
            <h1 class="text-5xl md:text-6xl font-light text-gray-900 dark:text-white mb-4 tracking-tight">
                Sistem Pergudangan
            </h1>
            
            <h2 class="text-3xl md:text-4xl font-light mb-8" style="color:var(--green-600)">
                Toko Indonesia
            </h2>
            
            <p class="text-lg text-gray-500 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Kelola stok barang dan supplier dengan sistem yang sederhana, cepat, dan efisien.
            </p>
        </div>
    </section>

    <!-- Role Cards -->
    <section class="pb-24 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="grid md:grid-cols-2 gap-8">

                <!-- Petugas Gudang -->
                <div class="gradient-border card-shadow p-8">
                    <div class="mb-6">
                        <div class="icon-box w-14 h-14 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">Petugas Gudang</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                            Akses untuk melihat dan memantau stok barang di gudang.
                        </p>
                    </div>
                    
                    <a href="{{ route('gudang.index') }}" 
                       class="btn-secondary inline-block w-full text-center py-3 text-sm rounded-lg transition-all">
                        Masuk sebagai Petugas
                    </a>
                    
                    <p class="text-xs text-gray-400 dark:text-gray-600 mt-4 text-center">
                        Akses langsung · Tanpa login
                    </p>
                </div>

                <!-- Administrator -->
                <div class="gradient-border card-shadow p-8">
                    <div class="mb-6">
                        <div class="icon-box w-14 h-14 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">Administrator</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                            Akses penuh untuk mengelola data barang dan supplier.
                        </p>
                    </div>
                    
                    @auth
                        <a href="{{ route('admin.dashboard') }}" 
                           class="btn-primary inline-block w-full text-center py-3 text-sm rounded-lg transition-all shadow-sm">
                            Lanjut ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="btn-primary inline-block w-full text-center py-3 text-sm rounded-lg transition-all shadow-sm">
                            Login sebagai Admin
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="section-alt py-24 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-xs font-medium tracking-widest uppercase mb-3 block" style="color:var(--green-600)">01 · TENTANG</span>
                <h2 class="text-3xl font-light text-gray-900 dark:text-white mb-4 tracking-tight">
                    Tentang Aplikasi
                </h2>
                <div class="divider-green w-24 mx-auto"></div>
            </div>
          
            <div class="grid md:grid-cols-3 gap-6">
                <div class="text-center p-6">
                    <div class="text-5xl font-thin section-num mb-4">01</div>
                    <h3 class="text-base font-medium text-gray-900 dark:text-white mb-3">Manajemen Barang</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                        Kelola data barang dengan mudah dan terstruktur.
                    </p>
                </div>
                
                <div class="text-center p-6">
                    <div class="text-5xl font-thin section-num mb-4">02</div>
                    <h3 class="text-base font-medium text-gray-900 dark:text-white mb-3">Data Supplier</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                        Informasi lengkap supplier dalam satu tempat.
                    </p>
                </div>
                
                <div class="text-center p-6">
                    <div class="text-5xl font-thin section-num mb-4">03</div>
                    <h3 class="text-base font-medium text-gray-900 dark:text-white mb-3">Monitoring Stok</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                        Pantau kondisi stok barang secara real-time.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="fitur" class="py-24 px-6 bg-white dark:bg-gray-950">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-xs font-medium tracking-widest uppercase mb-3 block" style="color:var(--green-600)">02 · FITUR</span>
                <h2 class="text-3xl font-light text-gray-900 dark:text-white mb-4 tracking-tight">
                    Fitur Unggulan
                </h2>
                <div class="divider-green w-24 mx-auto"></div>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="feature-card p-6 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800">
                    <span class="text-xs font-mono mb-3 block" style="color:var(--green-500)">F01</span>
                    <h3 class="text-base font-medium text-gray-900 dark:text-white mb-2">Pencarian Cepat</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                        Cari barang berdasarkan ID atau nama dengan instant search.
                    </p>
                </div>

                <div class="feature-card p-6 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800">
                    <span class="text-xs font-mono mb-3 block" style="color:var(--green-500)">F02</span>
                    <h3 class="text-base font-medium text-gray-900 dark:text-white mb-2">Filter Kategori</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                        Saring barang berdasarkan kategori untuk memudahkan pencarian.
                    </p>
                </div>

                <div class="feature-card p-6 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800">
                    <span class="text-xs font-mono mb-3 block" style="color:var(--green-500)">F03</span>
                    <h3 class="text-base font-medium text-gray-900 dark:text-white mb-2">CRUD Barang</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                        Tambah, edit, hapus data barang dengan mudah.
                    </p>
                </div>

                <div class="feature-card p-6 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800">
                    <span class="text-xs font-mono mb-3 block" style="color:var(--green-500)">F04</span>
                    <h3 class="text-base font-medium text-gray-900 dark:text-white mb-2">CRUD Supplier</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                        Kelola data supplier dengan sistem terintegrasi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center text-xs text-gray-400 dark:text-gray-600">
                <div class="flex items-center gap-2">
                    <div style="width:16px;height:16px;background:var(--green-600);border-radius:4px;display:inline-flex;align-items:center;justify-content:center;">
                        <svg width="9" height="9" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5"/></svg>
                    </div>
                    © 2026 Toko Indonesia. All rights reserved.
                </div>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <span>Sistem Pergudangan v1.0</span>
                    <span class="text-gray-200 dark:text-gray-700"></span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>