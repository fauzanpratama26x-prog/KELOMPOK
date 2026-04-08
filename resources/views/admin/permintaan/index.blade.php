@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Admin Dashboard - Approval Permintaan Stok</h2>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-3 text-left">Gerai</th>
                                <th class="border p-3 text-left">Barang</th>
                                <th class="border p-3 text-left">Qty</th>
                                <th class="border p-3 text-left">Status</th>
                                <th class="border p-3 text-left">Tanggal</th>
                                <th class="border p-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permintaans as $req)
                            <tr class="hover:bg-gray-50">
                                <td class="border p-3">{{ $req->gerai->nama }}</td>
                                <td class="border p-3">{{ $req->barang->nama_barang }}</td>
                                <td class="border p-3">{{ $req->quantity }}</td>
                                <td class="border p-3">
                                    <span class="px-2 py-1 rounded text-sm font-semibold
                                        {{ $req->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                        {{ $req->status === 'approved' ? 'bg-green-200 text-green-800' : '' }}
                                        {{ $req->status === 'rejected' ? 'bg-red-200 text-red-800' : '' }}
                                        {{ $req->status === 'shipped' ? 'bg-blue-200 text-blue-800' : '' }}
                                        {{ $req->status === 'received' ? 'bg-gray-200 text-gray-800' : '' }}
                                    ">{{ ucfirst($req->status) }}</span>
                                </td>
                                <td class="border p-3">{{ $req->created_at->format('d-m-Y H:i') }}</td>
                                <td class="border p-3 text-center">
                                    @if($req->status === 'pending')
                                    <form method="POST" style="display:inline;">
                                        @csrf
                                        <button formaction="{{ route('admin.permintaan.approve', $req) }}" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 mr-2">Approve</button>
                                        <button formaction="{{ route('admin.permintaan.reject', $req) }}" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Reject</button>
                                    </form>
                                    @else
                                    <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="border p-3 text-center text-gray-500">Tidak ada permintaan stok</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    <a href="{{ route('admin.barang-masuk.index') }}" class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 mr-4">Approval Barang Masuk Gudang</a>
                </div>

                <div class="mt-6">
                    <a href="{{ route('admin.suplier.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 ml-2">Kelola Supplier</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
