@extends("layouts.app")

@section("content")
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Gudang Dashboard - Distribusi Barang</h2>

                @if(session("success"))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session("success") }}
                    </div>
                @endif

                @if(session("error"))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        {{ session("error") }}
                    </div>
                @endif

                <h3 class="text-lg font-semibold mt-6 mb-4">Permintaan Barang Masuk ke Admin</h3>
                <form method="POST" action="{{ route('gudang.permintaan-barang-masuk.store') }}" class="mb-6 p-6 bg-gray-50 border border-gray-200 rounded">
                    @csrf

                    <!-- Pilih Jenis Permintaan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Permintaan</label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" name="jenis_permintaan" value="existing" checked class="mr-2" onchange="toggleForm()">
                                <span class="text-sm">Tambah Stok Barang Yang Ada</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="jenis_permintaan" value="new" class="mr-2" onchange="toggleForm()">
                                <span class="text-sm">Buat Barang Baru</span>
                            </label>
                        </div>
                    </div>

                    <!-- Form untuk Barang Yang Ada -->
                    <div id="existing-form" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pilih Barang</label>
                            <select name="barang" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barangs as $brg)
                                    <option value="{{ $brg->id_barang }}">{{ $brg->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah Masuk</label>
                            <input type="number" name="quantity" min="1" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Catatan</label>
                            <input type="text" name="notes" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Keterangan barang masuk">
                        </div>
                    </div>

                    <!-- Form untuk Barang Baru -->
                    <div id="new-form" class="hidden grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Barang Baru</label>
                            <input type="text" name="nama_barang_baru" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Masukkan nama barang baru">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="kategori_baru" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Makanan">Makanan</option>
                                <option value="Kosmetik">Kosmetik</option>
                                <option value="Aksesoris">Aksesoris</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Harga</label>
                            <input type="number" name="harga_baru" min="0" step="0.01" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Masukkan harga barang">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Suplier</label>
                            <select name="suplier_baru" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                <option value="">-- Pilih Suplier --</option>
                                @foreach($supliers as $suplier)
                                    <option value="{{ $suplier->id_suplier }}">{{ $suplier->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Jumlah Stok Awal</label>
                            <input type="number" name="quantity" min="1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Masukkan jumlah stok awal">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Catatan</label>
                            <input type="text" name="notes" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Keterangan barang baru">
                        </div>
                    </div>

                    <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Kirim Permintaan ke Admin</button>
                </form>

                <script>
                function toggleForm() {
                    const jenisPermintaan = document.querySelector('input[name="jenis_permintaan"]:checked').value;
                    const existingForm = document.getElementById('existing-form');
                    const newForm = document.getElementById('new-form');

                    if (jenisPermintaan === 'existing') {
                        existingForm.classList.remove('hidden');
                        newForm.classList.add('hidden');
                        // Set required attributes
                        document.querySelector('select[name="barang"]').setAttribute('required', '');
                        document.querySelector('input[name="quantity"]').setAttribute('required', '');
                        document.querySelector('[name="nama_barang_baru"]').removeAttribute('required');
                        document.querySelector('[name="kategori_baru"]').removeAttribute('required');
                        document.querySelector('[name="harga_baru"]').removeAttribute('required');
                        document.querySelector('select[name="suplier_baru"]').removeAttribute('required');
                    } else {
                        existingForm.classList.add('hidden');
                        newForm.classList.remove('hidden');
                        // Set required attributes
                        document.querySelector('select[name="barang"]').removeAttribute('required');
                        document.querySelector('input[name="quantity"]').removeAttribute('required');
                        document.querySelector('[name="nama_barang_baru"]').setAttribute('required', '');
                        document.querySelector('[name="kategori_baru"]').setAttribute('required', '');
                        document.querySelector('[name="harga_baru"]').setAttribute('required', '');
                        document.querySelector('select[name="suplier_baru"]').setAttribute('required', '');
                    }
                }
                </script>

                <h3 class="text-lg font-semibold mt-6 mb-4">Permintaan Barang Masuk yang Disetujui - Siap Input</h3>
                <div class="overflow-x-auto mb-6">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead class="bg-green-100">
                            <tr>
                                <th class="border p-3">Barang</th>
                                <th class="border p-3">Qty</th>
                                <th class="border p-3">Status</th>
                                <th class="border p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permintaanMasuks->where('status', 'approved') as $req)
                            <tr class="hover:bg-gray-50">
                                <td class="border p-3">
                                    @if($req->nama_barang_baru)
                                        <div>
                                            <strong>Barang Baru:</strong> {{ $req->nama_barang_baru }}<br>
                                            <small>Kategori: {{ $req->kategori_baru }} | Harga: Rp {{ number_format($req->harga_baru, 0, ',', '.') }}</small>
                                        </div>
                                    @else
                                        {{ $req->barang->nama_barang }}
                                    @endif
                                </td>
                                <td class="border p-3">{{ $req->quantity }}</td>
                                <td class="border p-3"><span class="px-2 py-1 rounded text-sm bg-green-200 text-green-800">Approved</span></td>
                                <td class="border p-3">
                                    <form method="POST" action="{{ route('gudang.barang-masuk.store') }}" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="permintaan_id" value="{{ $req->id }}">
                                        <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Input Barang Masuk</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="border p-3 text-center text-gray-500">Tidak ada permintaan yang disetujui</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <h3 class="text-lg font-semibold mt-6 mb-4">Permintaan yang Disetujui & Harus Dikirim</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-3">Gerai</th>
                                <th class="border p-3">Barang</th>
                                <th class="border p-3">Qty</th>
                                <th class="border p-3">Status</th>
                                <th class="border p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $req)
                            <tr class="hover:bg-gray-50">
                                <td class="border p-3">{{ $req->gerai->nama }}</td>
                                <td class="border p-3">{{ $req->barang->nama_barang }}</td>
                                <td class="border p-3">{{ $req->quantity }}</td>
                                <td class="border p-3">
                                    <span class="px-2 py-1 rounded text-sm font-semibold {{ $req->status === "approved" ? "bg-green-200 text-green-800" : "bg-blue-200 text-blue-800" }}">{{ ucfirst($req->status) }}</span>
                                </td>
                                <td class="border p-3">
                                    @if($req->status === "approved")
                                    <form method="POST" style="display:inline;">
                                        @csrf
                                        <button formaction="{{ route("gudang.permintaan.ship", $req) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Kirim</button>
                                    </form>
                                    @elseif($req->status === "shipped")
                                    <form method="POST" style="display:inline;">
                                        @csrf
                                        <button formaction="{{ route("gudang.permintaan.receive", $req) }}" class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-gray-600">Konfirmasi Terima</button>
                                    </form>
                                    @else
                                    <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="border p-3 text-center text-gray-500">Tidak ada permintaan untuk dikirim</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $requests->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection