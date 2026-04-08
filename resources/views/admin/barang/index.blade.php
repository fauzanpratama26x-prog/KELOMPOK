<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Toko Indonesia - Admin Barang</title>

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

        /* User dropdown button */
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

        /* Dropdown menu */
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

        /* Header */
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

        /* Add button */
        .btn-add {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background: var(--green-700);
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            border-radius: 0.5rem;
            transition: background 0.2s;
        }
        .btn-add:hover { background: var(--green-800); }
        .dark .btn-add { background: var(--green-600); }
        .dark .btn-add:hover { background: var(--green-500); }

        /* Alert success */
        .alert-success {
            margin-bottom: 1rem;
            background: var(--green-50);
            border: 1px solid var(--green-200);
            color: var(--green-800);
            padding: 0.6rem 1rem;
            font-size: 0.875rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .dark .alert-success {
            background: rgba(22, 101, 52, 0.15);
            border-color: rgba(74, 222, 128, 0.2);
            color: var(--green-300);
        }

        /* Cards */
        .card {
            background: #ffffff;
            border: 1px solid var(--green-100);
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(22, 163, 74, 0.05);
        }
        .dark .card {
            background: #0d1f12;
            border-color: rgba(74, 222, 128, 0.08);
        }

        /* Form inputs */
        .form-input, .form-select {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            border: 1px solid var(--green-200);
            border-radius: 0.5rem;
            background: #ffffff;
            color: #111827;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-input { width: 100%; box-sizing: border-box; }
        .form-input::placeholder { color: #9ca3af; }
        .form-input:focus, .form-select:focus {
            border-color: var(--green-500);
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.12);
        }
        .dark .form-input, .dark .form-select {
            background: #0a1a0f;
            border-color: rgba(74, 222, 128, 0.15);
            color: #d1fae5;
        }
        .dark .form-input::placeholder { color: #4b5563; }
        .dark .form-input:focus, .dark .form-select:focus {
            border-color: var(--green-500);
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.1);
        }

        /* Filter/search buttons */
        .btn-filter {
            padding: 0.5rem 1.25rem;
            background: var(--green-700);
            color: #ffffff;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.5rem;
            white-space: nowrap;
            transition: background 0.2s;
        }
        .btn-filter:hover { background: var(--green-800); }
        .dark .btn-filter { background: var(--green-600); }
        .dark .btn-filter:hover { background: var(--green-500); }

        .btn-reset {
            padding: 0.5rem 1.25rem;
            background: var(--green-50);
            color: var(--green-800);
            border: 1px solid var(--green-200);
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.5rem;
            white-space: nowrap;
            transition: background 0.2s;
        }
        .btn-reset:hover { background: var(--green-100); }
        .dark .btn-reset {
            background: rgba(22, 101, 52, 0.15);
            color: var(--green-400);
            border-color: rgba(74, 222, 128, 0.15);
        }

        /* Table */
        .table-wrap {
            background: #ffffff;
            border: 1px solid var(--green-100);
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(22, 163, 74, 0.05);
        }
        .dark .table-wrap {
            background: #0d1f12;
            border-color: rgba(74, 222, 128, 0.08);
        }

        thead { background: var(--green-50); }
        .dark thead { background: rgba(22, 101, 52, 0.12); }

        th {
            color: var(--green-800);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.75rem 1.5rem;
            text-align: left;
        }
        .dark th { color: var(--green-400); }

        tbody tr { border-top: 1px solid var(--green-50); transition: background 0.15s; }
        .dark tbody tr { border-top-color: rgba(74, 222, 128, 0.05); }
        tbody tr:hover { background: var(--green-50); }
        .dark tbody tr:hover { background: rgba(22, 101, 52, 0.08); }

        td {
            padding: 1rem 1.5rem;
            font-size: 0.875rem;
            color: #374151;
            white-space: nowrap;
        }
        .dark td { color: #d1fae5; }

        /* Badge kategori */
        .badge-kategori {
            background: var(--green-50);
            color: var(--green-800);
            border: 1px solid var(--green-200);
            font-size: 0.7rem;
            padding: 2px 10px;
            border-radius: 9999px;
        }
        .dark .badge-kategori {
            background: rgba(22, 101, 52, 0.2);
            color: var(--green-300);
            border-color: rgba(74, 222, 128, 0.15);
        }

        .stok-menipis { color: #dc2626; font-weight: 500; }
        .dark .stok-menipis { color: #f87171; }

        /* Action buttons */
        .btn-edit {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.625rem;
            font-size: 0.75rem;
            font-weight: 500;
            border-radius: 0.375rem;
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
            transition: background 0.15s;
        }
        .btn-edit:hover { background: #fde68a; }
        .dark .btn-edit {
            background: rgba(146, 64, 14, 0.2);
            color: #fcd34d;
            border-color: rgba(253, 230, 138, 0.2);
        }
        .dark .btn-edit:hover { background: rgba(146, 64, 14, 0.35); }

        .btn-delete {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.625rem;
            font-size: 0.75rem;
            font-weight: 500;
            border-radius: 0.375rem;
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            transition: background 0.15s;
            cursor: pointer;
        }
        .btn-delete:hover { background: #fecaca; }
        .dark .btn-delete {
            background: rgba(153, 27, 27, 0.2);
            color: #fca5a5;
            border-color: rgba(252, 165, 165, 0.2);
        }
        .dark .btn-delete:hover { background: rgba(153, 27, 27, 0.35); }

        /* Empty state */
        .empty-icon { color: var(--green-300); }
        .dark .empty-icon { color: var(--green-800); }

        .btn-empty {
            display: inline-flex;
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background: var(--green-700);
            color: #ffffff;
            font-size: 0.875rem;
            border-radius: 0.5rem;
            transition: background 0.2s;
        }
        .btn-empty:hover { background: var(--green-800); }

        /* Table footer */
        .table-footer {
            border-top: 1px solid var(--green-100);
            padding: 1rem 1.5rem;
        }
        .dark .table-footer { border-color: rgba(74, 222, 128, 0.06); }

        /* Site footer */
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

    <!-- Navbar -->
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
                           class="nav-active nav-link inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium transition">
                            Barang
                        </a>
                        <a href="{{ route('admin.suplier.index') }}" 
                           class="nav-link inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium transition">
                            Suplier
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

    <!-- Header -->
    <header class="page-header pt-20">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <span class="header-label">ADMIN</span>
                    <h2 class="text-2xl font-light text-gray-900 dark:text-white mt-1">Manajemen Barang</h2>
                </div>
                <a href="{{ route('admin.barang.create') }}" class="btn-add">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Barang
                </a>
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-5">

            @if(session('success'))
                <div class="alert-success">
                    <svg class="w-4 h-4 flex-shrink-0" style="color:var(--green-600)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filter -->
            <div class="card p-5">
                <form method="GET" action="{{ route('admin.barang.index') }}" class="flex gap-3 flex-wrap">
                    <div class="flex-1 min-w-48">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari ID atau Nama Barang..."
                               class="form-input">
                    </div>
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        <option value="Makanan" {{ request('kategori') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="Kosmetik" {{ request('kategori') == 'Kosmetik' ? 'selected' : '' }}>Kosmetik</option>
                        <option value="Aksesoris" {{ request('kategori') == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                    </select>
                    <button type="submit" class="btn-filter">Filter</button>
                    @if(request('search') || request('kategori'))
                        <a href="{{ route('admin.barang.index') }}" class="btn-reset">Reset</a>
                    @endif
                </form>
            </div>

            <!-- Table -->
            <div class="table-wrap">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kategori</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Supplier</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barangs as $barang)
                            <tr>
                                <td class="font-mono text-gray-900 dark:text-green-100">{{ $barang->id_barang }}</td>
                                <td><span class="badge-kategori">{{ $barang->kategori }}</span></td>
                                <td class="font-medium text-gray-900 dark:text-green-50">{{ $barang->nama_barang }}</td>
                                <td class="text-gray-500 dark:text-green-200">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                                <td class="{{ $barang->stok < 20 ? 'stok-menipis' : 'text-gray-600 dark:text-green-200' }}">
                                    {{ $barang->stok }}
                                </td>
                                <td class="text-gray-500 dark:text-green-200">{{ $barang->suplierRelasi->nama ?? '-' }}</td>
                                <td>
                                    <div style="display:flex; gap:0.5rem;">
                                        <a href="{{ route('admin.barang.edit', $barang->id_barang) }}" class="btn-edit">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.barang.destroy', $barang->id_barang) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" style="padding:3rem; text-align:center; color:#9ca3af;">
                                    <svg class="empty-icon mx-auto mb-2" style="width:48px;height:48px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p style="font-size:0.875rem;">Tidak ada data barang</p>
                                    <a href="{{ route('admin.barang.create') }}" class="btn-empty">Tambah Barang Pertama</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($barangs->hasPages())
                <div class="table-footer">
                    {{ $barangs->links() }}
                </div>
                @endif
            </div>

        </div>
    </main>

    <!-- Footer -->
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