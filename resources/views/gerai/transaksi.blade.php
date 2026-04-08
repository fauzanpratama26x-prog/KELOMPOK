@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Gerai Dashboard - Transaksi Penjualan</h2>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Form Transaksi Penjualan -->
                <div class="mb-8 p-6 bg-gray-50 border border-gray-200 rounded">
                    <h3 class="text-lg font-semibold mb-4">Catat Transaksi Penjualan</h3>
                    <form method="POST" action="{{ route('gerai.transaksi.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Barang</label>
                                <select name="barang" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                    <option value="">-- Pilih Barang --</option>
                                    @foreach($barangs as $brg)
                                        <option value="{{ $brg->id_barang }}">{{ $brg->nama_barang }} (Rp {{ number_format($brg->harga, 0, ',', '.') }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                                <input type="number" name="quantity" min="1" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            </div>
                        </div>
                        <button type="submit" class="mt-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Catat Transaksi</button>
                    </form>
                </div>

                <!-- Riwayat Transaksi -->
                <h3 class="text-lg font-semibold mb-4">Riwayat Transaksi</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-3">Tanggal</th>
                                <th class="border p-3">Barang</th>
                                <th class="border p-3">Qty</th>
                                <th class="border p-3">Total Harga</th>
                                <th class="border p-3">Kasir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksis as $trx)
                            <tr>
                                <td class="border p-3">{{ $trx->created_at->format('d-m-Y H:i') }}</td>
                                <td class="border p-3">{{ $trx->barang->nama_barang }}</td>
                                <td class="border p-3">{{ $trx->quantity }}</td>
                                <td class="border p-3">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                                <td class="border p-3">{{ $trx->user->name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="border p-3 text-center text-gray-500">Belum ada transaksi</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $transaksis->links() }}
                </div>

                <div class="mt-6">
                    <a href="{{ route('gerai.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Kembali ke Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
