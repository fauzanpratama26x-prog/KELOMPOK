@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-slate-200">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Gerai - Transaksi Penjualan</h2>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                
                <div class="mb-8 p-6 bg-slate-50 border border-slate-200 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4 text-slate-900">Catat Transaksi Penjualan</h3>
                    <form method="POST" action="{{ route('gerai.transaksi.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700">Barang</label>
                                <select name="barang" required class="mt-1 block w-full border border-slate-300 rounded-lg shadow-sm p-2 text-slate-900">
                                    <option value="">-- Pilih Barang --</option>
                                    @foreach($barangs as $brg)
                                        <option value="{{ $brg->id_barang }}">{{ $brg->nama_barang }} (Rp {{ number_format($brg->harga, 0, ',', '.') }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700">Jumlah</label>
                                <input type="number" name="quantity" min="1" required class="mt-1 block w-full border border-slate-300 rounded-lg shadow-sm p-2 text-slate-900">
                            </div>
                        </div>
                        <button type="submit" class="mt-4 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium">Catat Transaksi</button>
                    </form>
                </div>

                
                <h3 class="text-lg font-semibold mb-4 text-slate-900">Riwayat Transaksi</h3>
                <div class="overflow-x-auto rounded-lg border border-slate-200">
                    <table class="min-w-full border-collapse border border-slate-300">
                        <thead class="bg-slate-100">
                            <tr>
                                <th class="border p-3 text-slate-900">Tanggal</th>
                                <th class="border p-3 text-slate-900">Barang</th>
                                <th class="border p-3 text-slate-900">Qty</th>
                                <th class="border p-3 text-slate-900">Total Harga</th>
                                <th class="border p-3 text-slate-900">Kasir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksis as $trx)
                            <tr class="hover:bg-slate-50">
                                <td class="border p-3 text-slate-900">{{ $trx->created_at->format('d-m-Y H:i') }}</td>
                                <td class="border p-3 text-slate-900">{{ $trx->barang->nama_barang }}</td>
                                <td class="border p-3 text-slate-900">{{ $trx->quantity }}</td>
                                <td class="border p-3 text-slate-900">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                                <td class="border p-3 text-slate-900">{{ $trx->user->name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="border p-3 text-center text-slate-500">Belum ada transaksi</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $transaksis->links() }}
                </div>

                <div class="mt-6">
                    <a href="{{ route('gerai.index') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium">Kembali ke Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
