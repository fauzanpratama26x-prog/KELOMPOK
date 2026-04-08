@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-slate-200">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-900">Detail Barang</h2>
                    <a href="{{ route('admin.barang.index') }}" class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 font-medium">
                        Kembali
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700">ID Barang</label>
                            <p class="mt-1 text-sm text-slate-900 bg-slate-50 px-3 py-2 rounded">{{ $barang->id_barang }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700">Nama Barang</label>
                            <p class="mt-1 text-sm text-slate-900 bg-slate-50 px-3 py-2 rounded">{{ $barang->nama_barang }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700">Kategori</label>
                            <p class="mt-1 text-sm text-slate-900 bg-slate-50 px-3 py-2 rounded">{{ $barang->kategori }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Harga</label>
                            <p class="mt-1 text-sm text-slate-900 bg-slate-50 px-3 py-2 rounded">Rp {{ number_format($barang->harga, 0, ',', '.') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700">Stok</label>
                            <p class="mt-1 text-sm text-slate-900 bg-slate-50 px-3 py-2 rounded">{{ $barang->stok }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700">Supplier</label>
                            <p class="mt-1 text-sm text-slate-900 bg-slate-50 px-3 py-2 rounded">{{ $barang->suplierRelasi->nama ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('admin.barang.edit', $barang->id_barang) }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium">
                        Edit Barang
                    </a>
                    <form action="{{ route('admin.barang.destroy', $barang->id_barang) }}"
                          method="POST"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium">
                            Hapus Barang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection