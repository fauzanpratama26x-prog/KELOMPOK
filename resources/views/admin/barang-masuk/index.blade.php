@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Admin Dashboard - Approval Permintaan Barang Masuk Gudang</h2>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-3 text-left">Barang</th>
                                <th class="border p-3 text-left">Qty</th>
                                <th class="border p-3 text-left">Catatan</th>
                                <th class="border p-3 text-left">Tanggal</th>
                                <th class="border p-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permintaanMasuks as $req)
                            <tr class="hover:bg-gray-50">
                                <td class="border p-3">
                                    @if($req->nama_barang_baru)
                                        <div>
                                            <strong>Barang Baru:</strong> {{ $req->nama_barang_baru }}<br>
                                            <small>Kategori: {{ $req->kategori_baru }} | Harga: Rp {{ number_format($req->harga_baru, 0, ',', '.') }}</small>
                                        </div>
                                    @elseif($req->barang)
                                        {{ $req->barang->nama_barang }}
                                    @else
                                        Barang tidak ditemukan
                                    @endif
                                </td>
                                <td class="border p-3">{{ $req->quantity }}</td>
                                <td class="border p-3">{{ $req->notes ?? '-' }}</td>
                                <td class="border p-3">{{ $req->created_at->format('d-m-Y H:i') }}</td>
                                <td class="border p-3 text-center">
                                    <form method="POST" style="display:inline;">
                                        @csrf
                                        <button formaction="{{ route('admin.barang-masuk.approve', $req) }}" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 mr-2">Approve</button>
                                        <button formaction="{{ route('admin.barang-masuk.reject', $req) }}" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Reject</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="border p-3 text-center text-gray-500">Tidak ada permintaan barang masuk</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $permintaanMasuks->links() }}
                </div>

                <div class="mt-6">
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Kembali ke Dashboard Utama</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection