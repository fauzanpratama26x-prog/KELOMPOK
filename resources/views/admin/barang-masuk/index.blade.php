@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-slate-200">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">Admin - Approval Permintaan Barang Masuk</h2>
                        <p class="mt-2 text-sm text-slate-600">Kelola permintaan barang masuk dari gudang.</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium">Kembali ke Dashboard</a>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto rounded-lg border border-slate-200 shadow-sm">
                    <table class="min-w-full border-collapse border border-slate-300">
                        <thead class="bg-slate-100">
                            <tr>
                                <th class="border p-3 text-left text-slate-900">Barang</th>
                                <th class="border p-3 text-left text-slate-900">Qty</th>
                                <th class="border p-3 text-left text-slate-900">Catatan</th>
                                <th class="border p-3 text-left text-slate-900">Tanggal</th>
                                <th class="border p-3 text-center text-slate-900">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permintaanMasuks as $req)
                            <tr class="hover:bg-slate-50">
                                <td class="border p-3 text-slate-900">
                                    @if($req->nama_barang_baru)
                                        <div>
                                            <strong>Barang Baru:</strong> {{ $req->nama_barang_baru }}<br>
                                            <small>Kategori: {{ $req->kategori_baru }} | Harga: Rp {{ number_format($req->harga_baru, 0, ',', '.') }}</small>
                                        </div>
                                    @elseif($req->barang)
                                        {{ $req->barang->nama_barang }}
                                    @else
                                        <span class="text-slate-500">Barang tidak ditemukan</span>
                                    @endif
                                </td>
                                <td class="border p-3 text-slate-900">{{ $req->quantity }}</td>
                                <td class="border p-3 text-slate-900">{{ $req->notes ?? '-' }}</td>
                                <td class="border p-3 text-slate-900">{{ $req->created_at->format('d-m-Y H:i') }}</td>
                                <td class="border p-3 text-center">
                                    <form method="POST" style="display:inline;">
                                        @csrf
                                        <button formaction="{{ route('admin.barang-masuk.approve', $req) }}" class="px-3 py-1 bg-emerald-600 text-white rounded hover:bg-emerald-700 font-medium mr-2">Approve</button>
                                        <button formaction="{{ route('admin.barang-masuk.reject', $req) }}" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Reject</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="border p-3 text-center text-slate-500">Tidak ada permintaan barang masuk</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $permintaanMasuks->links() }}
                </div>

                <div class="mt-6">
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-emerald-600 text-white rounded hover:bg-emerald-700 font-medium">Kembali ke Dashboard Utama</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection