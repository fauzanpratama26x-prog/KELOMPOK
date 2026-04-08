@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-slate-200">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Admin - Approval Permintaan Stok Gerai</h2>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto rounded-lg border border-slate-200">
                    <table class="min-w-full border-collapse border border-slate-300">
                        <thead class="bg-slate-100">
                            <tr>
                                <th class="border p-3 text-left text-slate-900">Gerai</th>
                                <th class="border p-3 text-left text-slate-900">Barang</th>
                                <th class="border p-3 text-left text-slate-900">Qty</th>
                                <th class="border p-3 text-left text-slate-900">Status</th>
                                <th class="border p-3 text-left text-slate-900">Tanggal</th>
                                <th class="border p-3 text-center text-slate-900">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permintaans as $req)
                            <tr class="hover:bg-slate-50">
                                <td class="border p-3 text-slate-900">{{ $req->gerai->nama }}</td>
                                <td class="border p-3 text-slate-900">{{ $req->barang->nama_barang }}</td>
                                <td class="border p-3 text-slate-900">{{ $req->quantity }}</td>
                                <td class="border p-3">
                                    <span class="px-2 py-1 rounded text-sm font-semibold
                                        {{ $req->status === 'pending' ? 'bg-amber-100 text-amber-800' : '' }}
                                        {{ $req->status === 'approved' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                        {{ $req->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $req->status === 'shipped' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $req->status === 'received' ? 'bg-slate-200 text-slate-800' : '' }}
                                    ">{{ ucfirst($req->status) }}</span>
                                </td>
                                <td class="border p-3 text-slate-900">{{ $req->created_at->format('d-m-Y H:i') }}</td>
                                <td class="border p-3 text-center">
                                    @if($req->status === 'pending')
                                    <form method="POST" style="display:inline;">
                                        @csrf
                                        <button formaction="{{ route('admin.permintaan.approve', $req) }}" class="px-3 py-1 bg-emerald-600 text-white rounded hover:bg-emerald-700 mr-2 text-sm font-medium">Approve</button>
                                        <button formaction="{{ route('admin.permintaan.reject', $req) }}" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm font-medium">Reject</button>
                                    </form>
                                    @else
                                    <span class="text-slate-400">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="border p-3 text-center text-slate-500">Tidak ada permintaan stok</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    <a href="{{ route('admin.barang-masuk.index') }}" class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 mr-4">Approval Barang Masuk Gudang</a>
                </div>

                <div class="mt-6">
                    <a href="{{ route('admin.suplier.index') }}" class="px-4 py-2 bg-emerald-600 text-white rounded hover:bg-emerald-700 font-medium ml-2">Kelola Supplier</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
