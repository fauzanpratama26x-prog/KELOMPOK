<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Toko Indonesia - Admin Supplier</title>

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

        .btn-primary {
            display: inline-flex;
            align-items: center;
            padding: 0.45rem 0.875rem;
            background: var(--green-700);
            color: #ffffff;
            border: none;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background 0.15s;
            cursor: pointer;
        }
        .btn-primary:hover { background: var(--green-800); }
        .dark .btn-primary { background: var(--green-600); }
        .dark .btn-primary:hover { background: var(--green-500); }

        /* Alert success */
        .alert-success {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.75rem 1rem;
            background: var(--green-50);
            border: 1px solid var(--green-200);
            border-radius: 0.5rem;
            color: var(--green-800);
            font-size: 0.875rem;
        }
        .dark .alert-success {
            background: rgba(22, 101, 52, 0.12);
            border-color: rgba(74, 222, 128, 0.2);
            color: #86efac;
        }

        /* Table card */
        .table-card {
            background: #ffffff;
            border: 1px solid var(--green-100);
            border-radius: 0.875rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(22, 163, 74, 0.06);
        }
        .dark .table-card {
            background: #0d1f12;
            border-color: rgba(74, 222, 128, 0.08);
        }

        /* Table */
        .data-table { min-width: 100%; border-collapse: collapse; }

        .table-head { background: var(--green-50); }
        .dark .table-head { background: rgba(22, 101, 52, 0.15); }

        .th {
            padding: 0.75rem 1.5rem;
            text-align: left;
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--green-700);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .dark .th { color: var(--green-400); }

        .td {
            padding: 1rem 1.5rem;
            font-size: 0.875rem;
            border-top: 1px solid var(--green-50);
            color: #374151;
        }
        .dark .td {
            border-color: rgba(74, 222, 128, 0.05);
            color: #d1fae5;
        }

        .td-muted { color: #6b7280; }
        .dark .td-muted { color: #9ca3af; }

        .td-mono { font-family: monospace; font-size: 0.8rem; }

        .tr-hover:hover { background: var(--green-50); }
        .dark .tr-hover:hover { background: rgba(22, 101, 52, 0.08); }

        /* Action buttons */
        .btn-edit {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.625rem;
            background: var(--green-50);
            color: var(--green-800);
            border: 1px solid var(--green-200);
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
            transition: background 0.15s;
        }
        .btn-edit:hover { background: var(--green-100); }
        .dark .btn-edit {
            background: rgba(22, 101, 52, 0.15);
            color: var(--green-400);
            border-color: rgba(74, 222, 128, 0.15);
        }
        .dark .btn-edit:hover { background: rgba(22, 101, 52, 0.25); }

        .btn-delete {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.625rem;
            background: var(--green-50);
            color: #6b7280;
            border: 1px solid var(--green-100);
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
            transition: background 0.15s, color 0.15s;
            cursor: pointer;
        }
        .btn-delete:hover { background: #fee2e2; color: #dc2626; border-color: #fecaca; }
        .dark .btn-delete {
            background: rgba(22, 101, 52, 0.1);
            color: #9ca3af;
            border-color: rgba(74, 222, 128, 0.08);
        }
        .dark .btn-delete:hover { background: rgba(220, 38, 38, 0.15); color: #f87171; border-color: rgba(248, 113, 113, 0.2); }

        /* Empty state */
        .empty-icon { color: #9ca3af; }
        .dark .empty-icon { color: #4b5563; }

        .btn-empty {
            display: inline-flex;
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background: var(--green-700);
            color: #ffffff;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background 0.15s;
        }
        .btn-empty:hover { background: var(--green-800); }

        /* Pagination divider */
        .pagination-wrap {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--green-50);
        }
        .dark .pagination-wrap { border-color: rgba(74, 222, 128, 0.05); }

        /* Footer */
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
                        Manajemen Supplier
                    </h2>
                </div>
                <a href="{{ route('admin.suplier.create') }}" class="btn-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Supplier
                </a>
            </div>
        </div>
    </header>

    <main class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="alert-success">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-card">
                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead class="table-head">
                            <tr>
                                <th class="th">ID</th>
                                <th class="th">Nama</th>
                                <th class="th">Alamat</th>
                                <th class="th">Kota</th>
                                <th class="th">Telepon</th>
                                <th class="th">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($supliers as $suplier)
                            <tr class="tr-hover">
                                <td class="td td-mono">{{ $suplier->id_suplier }}</td>
                                <td class="td">{{ $suplier->nama }}</td>
                                <td class="td td-muted">{{ $suplier->alamat }}</td>
                                <td class="td td-muted">{{ $suplier->kota }}</td>
                                <td class="td td-muted">{{ $suplier->telepon }}</td>
                                <td class="td">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.suplier.edit', $suplier->id_suplier) }}" class="btn-edit">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.suplier.destroy', $suplier->id_suplier) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="td" style="text-align:center; padding: 3rem 1.5rem;">
                                    <svg class="mx-auto h-12 w-12 empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <p class="mt-2 text-sm td-muted">Tidak ada data supplier</p>
                                    <a href="{{ route('admin.suplier.create') }}" class="btn-empty">
                                        Tambah Supplier Pertama
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($supliers->hasPages())
                <div class="pagination-wrap">
                    {{ $supliers->links() }}
                </div>
                @endif
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