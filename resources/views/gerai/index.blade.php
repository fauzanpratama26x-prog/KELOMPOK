@extends("layouts.app")

@section("content")
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Gerai Dashboard - Permintaan Stok</h2>

                @if(session("success"))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session("success") }}
                    </div>
                @endif

                <h3 class="text-lg font-semibold mb-4">Form Permintaan Stok</h3>
                <form method="POST" action="{{ route("gerai.permintaan.store") }}" class="mb-8 p-6 bg-gray-50 border border-gray-200 rounded">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Barang</label>
                            <select name="barang" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barangs as $brg)
                                <option value="{{ $brg->id_barang }}">{{ $brg->nama_barang }} (Gudang: {{ $brg->stok }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                            <input type="number" name="quantity" min="1" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Catatan</label>
                            <input type="text" name="notes" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                    </div>
                    <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Kirim Permintaan</button>
                </form>

                <h3 class="text-lg font-semibold mb-4">Riwayat Permintaan</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-3">Barang</th>
                                <th class="border p-3">Qty</th>
                                <th class="border p-3">Status</th>
                                <th class="border p-3">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permintaans as $req)
                            <tr>
                                <td class="border p-3">{{ $req->barang->nama_barang }}</td>
                                <td class="border p-3">{{ $req->quantity }}</td>
                                <td class="border p-3"><span class="px-2 py-1 rounded text-sm {{ $req->status === "pending" ? "bg-yellow-200" : "bg-" . ($req->status === "approved" ? "green-200" : ($req->status === "shipped" ? "blue-200" : "gray-200")) }}">{{ ucfirst($req->status) }}</span></td>
                                <td class="border p-3">{{ $req->created_at->format("d-m-Y") }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="border p-3 text-center text-gray-500">Belum ada permintaan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    <a href="{{ route("gerai.transaksi.index") }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Lihat Transaksi Penjualan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection