@extends("layouts.app")

@section("content")
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-slate-200">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Gerai Dashboard - Permintaan Stok</h2>

                @if(session("success"))
                    <div class="mb-4 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg">
                        {{ session("success") }}
                    </div>
                @endif

                <h3 class="text-lg font-semibold mb-4 text-slate-900">Form Permintaan Stok</h3>
                <form method="POST" action="{{ route("gerai.permintaan.store") }}" class="mb-8 p-6 bg-slate-50 border border-slate-200 rounded-lg">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Barang</label>
                            <select name="barang" required class="mt-1 block w-full border border-slate-300 rounded-lg shadow-sm p-2 text-slate-900">
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barangs as $brg)
                                <option value="{{ $brg->id_barang }}">{{ $brg->nama_barang }} (Gudang: {{ $brg->stok }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Jumlah</label>
                            <input type="number" name="quantity" min="1" required class="mt-1 block w-full border border-slate-300 rounded-lg shadow-sm p-2 text-slate-900">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-700">Catatan</label>
                            <input type="text" name="notes" class="mt-1 block w-full border border-slate-300 rounded-lg shadow-sm p-2 text-slate-900">
                        </div>
                    </div>
                    <button type="submit" class="mt-4 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium">Kirim Permintaan</button>
                </form>

                <h3 class="text-lg font-semibold mb-4 text-slate-900">Riwayat Permintaan</h3>
                <div class="overflow-x-auto rounded-lg border border-slate-200">
                    <table class="min-w-full border-collapse border border-slate-300">
                        <thead class="bg-slate-100">
                            <tr>
                                <th class="border p-3 text-slate-900 text-left">Barang</th>
                                <th class="border p-3 text-slate-900 text-left">Qty</th>
                                <th class="border p-3 text-slate-900 text-left">Status</th>
                                <th class="border p-3 text-slate-900 text-left">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permintaans as $req)
                            <tr class="hover:bg-slate-50">
                                <td class="border p-3 text-slate-900">{{ $req->barang->nama_barang }}</td>
                                <td class="border p-3 text-slate-900">{{ $req->quantity }}</td>
                                <td class="border p-3"><span class="px-2 py-1 rounded text-sm font-medium {{ $req->status === "pending" ? "bg-amber-100 text-amber-800" : "" }}{{ $req->status === "approved" ? "bg-emerald-100 text-emerald-800" : "" }}{{ $req->status === "shipped" ? "bg-blue-100 text-blue-800" : "" }}{{ $req->status === "received" ? "bg-slate-200 text-slate-800" : "" }}">{{ ucfirst($req->status) }}</span></td>
                                <td class="border p-3 text-slate-900">{{ $req->created_at->format("d-m-Y") }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="border p-3 text-center text-slate-500">Belum ada permintaan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    <a href="{{ route("gerai.transaksi.index") }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium">Lihat Transaksi Penjualan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection