@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-slate-200">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Admin - Manajemen Barang</h2>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-6">
                    <a href="{{ route('admin.barang.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium">
                        Tambah Barang Baru
                    </a>
                </div>

                <div class="overflow-x-auto rounded-lg border border-slate-200">
                    <table class="min-w-full border-collapse border border-slate-300">
                        <thead class="bg-slate-100">
                            <tr>
                                <th class="border p-3 text-left text-slate-900">ID Barang</th>
                                <th class="border p-3 text-left text-slate-900">Nama Barang</th>
                                <th class="border p-3 text-left text-slate-900">Kategori</th>
                                <th class="border p-3 text-left text-slate-900">Harga</th>
                                <th class="border p-3 text-left text-slate-900">Supplier</th>
                                <th class="border p-3 text-center text-slate-900">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barangs as $barang)
                            <tr class="hover:bg-slate-50">
                                <td class="border p-3 text-slate-900">{{ $barang->id_barang }}</td>
                                <td class="border p-3 text-slate-900">{{ $barang->nama_barang }}</td>
                                <td class="border p-3 text-slate-900">{{ $barang->kategori }}</td>
                                <td class="border p-3 text-slate-900">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                                <td class="border p-3 text-slate-900">{{ $barang->suplier->nama ?? 'N/A' }}</td>
                                <td class="border p-3 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.barang.show', $barang->id_barang) }}" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 font-medium text-sm">
                                            Lihat
                                        </a>
                                        <a href="{{ route('admin.barang.edit', $barang->id_barang) }}" class="px-3 py-1 bg-emerald-600 text-white rounded hover:bg-emerald-700 font-medium text-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.barang.destroy', $barang->id_barang) }}"
                                              method="POST"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 font-medium text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="border p-3 text-center text-slate-500 py-8">
                                    <svg class="mx-auto h-12 w-12 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p class="text-sm text-slate-500 mb-4">Tidak ada data barang</p>
                                    <a href="{{ route('admin.barang.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium">
                                        Tambah Barang Pertama
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($barangs->hasPages())
                <div class="mt-6">
                    {{ $barangs->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection