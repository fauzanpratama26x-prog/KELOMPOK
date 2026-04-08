@extends("layouts.app")

@section("content")
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-slate-200">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Gudang - Distribusi Barang</h2>

                @if(session("success"))
                    <div class="mb-4 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg">
                        {{ session("success") }}
                    </div>
                @endif

                @if(session("error"))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        {{ session("error") }}
                    </div>
                @endif

                <section class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6 mb-6">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-6">
                        <div>
                            <h3 class="text-xl font-semibold text-slate-900">Permintaan Barang Masuk</h3>
                            <p class="text-sm text-slate-600">Ajukan permintaan stok atau barang baru dengan mudah. Pilih satu opsi permintaan.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('gudang.permintaan-barang-masuk.store') }}" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <label class="flex items-center gap-3 rounded-3xl border border-emerald-200 bg-emerald-50 px-4 py-4 text-sm font-medium text-slate-900">
                                <input type="radio" name="jenis_permintaan" value="existing" checked class="h-4 w-4 text-emerald-600" onchange="toggleForm()">
                                Tambah Stok Barang Yang Ada
                            </label>
                            <label class="flex items-center gap-3 rounded-3xl border border-slate-200 bg-white px-4 py-4 text-sm font-medium text-slate-900">
                                <input type="radio" name="jenis_permintaan" value="new" class="h-4 w-4 text-emerald-600" onchange="toggleForm()">
                                Buat Barang Baru
                            </label>
                        </div>

                        <div id="existing-form" class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div>
                                <label class="text-sm font-medium text-slate-700">Pilih Barang</label>
                                <select name="barang" required class="mt-2 block w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-100">
                                    <option value="">-- Pilih Barang --</option>
                                    @foreach($barangs as $brg)
                                        <option value="{{ $brg->id_barang }}">{{ $brg->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-slate-700">Jumlah Masuk</label>
                                <input type="number" name="quantity" min="1" required class="mt-2 block w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-100">
                            </div>
                            <div>
                                <label class="text-sm font-medium text-slate-700">Catatan</label>
                                <input type="text" name="notes" class="mt-2 block w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-100" placeholder="Keterangan barang masuk">
                            </div>
                        </div>

                        <div id="new-form" class="hidden grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label class="text-sm font-medium text-slate-700">Nama Barang Baru</label>
                                <input type="text" name="nama_barang_baru" class="mt-2 block w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-100" placeholder="Masukkan nama barang baru">
                            </div>
                            <div>
                                <label class="text-sm font-medium text-slate-700">Kategori</label>
                                <select name="kategori_baru" class="mt-2 block w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-100">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Makanan">Makanan</option>
                                    <option value="Kosmetik">Kosmetik</option>
                                    <option value="Aksesoris">Aksesoris</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-slate-700">Harga</label>
                                <input type="number" name="harga_baru" min="0" step="0.01" class="mt-2 block w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-100" placeholder="Masukkan harga barang">
                            </div>
                            <div>
                                <label class="text-sm font-medium text-slate-700">Suplier</label>
                                <select name="suplier_baru" class="mt-2 block w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-100">
                                    <option value="">-- Pilih Suplier --</option>
                                    @foreach($supliers as $suplier)
                                        <option value="{{ $suplier->id_suplier }}">{{ $suplier->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-slate-700">Jumlah Stok Awal</label>
                                <input type="number" name="quantity" min="1" class="mt-2 block w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-100" placeholder="Masukkan jumlah stok awal">
                            </div>
                            <div>
                                <label class="text-sm font-medium text-slate-700">Catatan</label>
                                <input type="text" name="notes" class="mt-2 block w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-100" placeholder="Keterangan barang baru">
                            </div>
                        </div>

                        <button type="submit" class="inline-flex items-center justify-center rounded-3xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-emerald-700">Kirim Permintaan ke Admin</button>
                    </form>
                </section>

                <script>
                    function toggleForm() {
                        const selected = document.querySelector('input[name="jenis_permintaan"]:checked');
                        const existingForm = document.getElementById('existing-form');
                        const newForm = document.getElementById('new-form');

                        if (!selected || selected.value === 'existing') {
                            existingForm.classList.remove('hidden');
                            newForm.classList.add('hidden');
                            document.querySelector('select[name="barang"]').setAttribute('required', '');
                            document.querySelector('input[name="quantity"]').setAttribute('required', '');
                            document.querySelector('[name="nama_barang_baru"]').removeAttribute('required');
                            document.querySelector('[name="kategori_baru"]').removeAttribute('required');
                            document.querySelector('[name="harga_baru"]').removeAttribute('required');
                            document.querySelector('select[name="suplier_baru"]').removeAttribute('required');
                        } else {
                            existingForm.classList.add('hidden');
                            newForm.classList.remove('hidden');
                            document.querySelector('select[name="barang"]').removeAttribute('required');
                            document.querySelector('input[name="quantity"]').removeAttribute('required');
                            document.querySelector('[name="nama_barang_baru"]').setAttribute('required', '');
                            document.querySelector('[name="kategori_baru"]').setAttribute('required', '');
                            document.querySelector('[name="harga_baru"]').setAttribute('required', '');
                            document.querySelector('select[name="suplier_baru"]').setAttribute('required', '');
                        }
                    }

                    document.addEventListener('DOMContentLoaded', toggleForm);
                </script>

                <h3 class="text-lg font-semibold mt-6 mb-4">Permintaan Barang Masuk yang Disetujui - Siap Input</h3>
                <div class="overflow-x-auto mb-6">
                    <table class="min-w-full border-collapse border border-slate-300">
                        <thead class="bg-slate-100">
                            <tr>
                                <th class="border p-3">Barang</th>
                                <th class="border p-3">Qty</th>
                                <th class="border p-3">Status</th>
                                <th class="border p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permintaanMasuks->where('status', 'approved') as $req)
                            <tr class="hover:bg-slate-50">
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
                                <td class="border p-3"><span class="px-2 py-1 rounded text-sm bg-emerald-100 text-emerald-800">Approved</span></td>
                                <td class="border p-3">
                                    <form method="POST" action="{{ route('gudang.barang-masuk.store') }}" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="permintaan_id" value="{{ $req->id }}">
                                        <button type="submit" class="px-3 py-1 bg-emerald-600 text-white rounded hover:bg-emerald-700 font-medium">Input Barang Masuk</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="border p-3 text-center text-slate-500">Tidak ada permintaan yang disetujui</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <h3 class="text-lg font-semibold mt-6 mb-4">Permintaan yang Disetujui & Harus Dikirim</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-slate-300">
                        <thead class="bg-slate-100">
                            <tr>
                                <th class="border p-3 text-slate-900">Gerai</th>
                                <th class="border p-3 text-slate-900">Barang</th>
                                <th class="border p-3 text-slate-900">Qty</th>
                                <th class="border p-3 text-slate-900">Status</th>
                                <th class="border p-3 text-slate-900">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $req)
                            <tr class="hover:bg-slate-50">
                                <td class="border p-3">{{ $req->gerai->nama }}</td>
                                <td class="border p-3">{{ $req->barang->nama_barang }}</td>
                                <td class="border p-3">{{ $req->quantity }}</td>
                                <td class="border p-3">
                                    <span class="px-2 py-1 rounded text-sm font-semibold {{ $req->status === "approved" ? "bg-emerald-100 text-emerald-800" : "bg-blue-100 text-blue-800" }}">{{ ucfirst($req->status) }}</span>
                                </td>
                                <td class="border p-3">
                                    @if($req->status === "approved")
                                    <form method="POST" style="display:inline;">
                                        @csrf
                                        <button formaction="{{ route("gudang.permintaan.ship", $req) }}" class="px-3 py-1 bg-emerald-600 text-white rounded hover:bg-emerald-700 font-medium">Kirim</button>
                                    </form>
                                    @elseif($req->status === "shipped")
                                    <form method="POST" style="display:inline;">
                                        @csrf
                                        <button formaction="{{ route("gudang.permintaan.receive", $req) }}" class="px-3 py-1 bg-slate-600 text-white rounded hover:bg-slate-700 font-medium">Konfirmasi Terima</button>
                                    </form>
                                    @else
                                    <span class="text-slate-400">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="border p-3 text-center text-slate-500">Tidak ada permintaan untuk dikirim</td>
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