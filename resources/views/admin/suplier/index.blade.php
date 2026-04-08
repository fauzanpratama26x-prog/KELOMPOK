@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-slate-200">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Admin - Manajemen Supplier</h2>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-6">
                    <a href="{{ route('admin.suplier.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium">
                        Tambah Supplier Baru
                    </a>
                </div>

                <div class="overflow-x-auto rounded-lg border border-slate-200">
                    <table class="min-w-full border-collapse border border-slate-300">
                        <thead class="bg-slate-100">
                            <tr>
                                <th class="border p-3 text-left text-slate-900">ID Supplier</th>
                                <th class="border p-3 text-left text-slate-900">Nama</th>
                                <th class="border p-3 text-left text-slate-900">Alamat</th>
                                <th class="border p-3 text-left text-slate-900">Kota</th>
                                <th class="border p-3 text-left text-slate-900">Telepon</th>
                                <th class="border p-3 text-center text-slate-900">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($supliers as $suplier)
                            <tr class="hover:bg-slate-50">
                                <td class="border p-3 text-slate-900">{{ $suplier->id_suplier }}</td>
                                <td class="border p-3 text-slate-900">{{ $suplier->nama }}</td>
                                <td class="border p-3 text-slate-900">{{ $suplier->alamat }}</td>
                                <td class="border p-3 text-slate-900">{{ $suplier->kota }}</td>
                                <td class="border p-3 text-slate-900">{{ $suplier->telepon }}</td>
                                <td class="border p-3 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.suplier.edit', $suplier->id_suplier) }}" class="px-3 py-1 bg-emerald-600 text-white rounded hover:bg-emerald-700 font-medium text-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.suplier.destroy', $suplier->id_suplier) }}"
                                              method="POST"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus supplier ini?')" style="display:inline;">
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
                                    <p class="text-sm text-slate-500 mb-4">Tidak ada data supplier</p>
                                    <a href="{{ route('admin.suplier.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium">
                                        Tambah Supplier Pertama
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($supliers->hasPages())
                <div class="mt-6">
                    {{ $supliers->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection