@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">Tambah Supplier Baru</h2>
                        <p class="mt-1 text-sm text-slate-600">Masukkan informasi supplier baru</p>
                    </div>
                    <a href="{{ route('admin.suplier.index') }}" class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 font-medium">
                        ← Kembali ke Daftar
                    </a>
                </div>
            </div>

            <div class="p-6">
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.suplier.store') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="id_suplier" class="text-sm font-medium text-slate-700">ID Supplier</label>
                            <input type="text"
                                   name="id_suplier"
                                   id="id_suplier"
                                   value="{{ old('id_suplier') }}"
                                   class="mt-2 block w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-100"
                                   required>
                            <p class="mt-1 text-xs text-slate-500">Format: SP + 2 digit angka</p>
                        </div>

                        <div>
                            <label for="nama" class="text-sm font-medium text-slate-700">Nama Supplier</label>
                            <input type="text"
                                   name="nama"
                                   id="nama"
                                   value="{{ old('nama') }}"
                                   class="mt-2 block w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-100"
                                   required>
                        </div>
                    </div>

                    <div>
                        <label for="alamat" class="text-sm font-medium text-slate-700">Alamat</label>
                        <textarea name="alamat"
                                  id="alamat"
                                  rows="3"
                                  class="mt-2 block w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-100"
                                  required>{{ old('alamat') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="kota" class="text-sm font-medium text-slate-700">Kota</label>
                            <input type="text"
                                   name="kota"
                                   id="kota"
                                   value="{{ old('kota') }}"
                                   class="mt-2 block w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-100"
                                   required>
                        </div>

                        <div>
                            <label for="telepon" class="text-sm font-medium text-slate-700">Telepon</label>
                            <input type="text"
                                   name="telepon"
                                   id="telepon"
                                   value="{{ old('telepon') }}"
                                   class="mt-2 block w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-100"
                                   required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="text-sm font-medium text-slate-700">Email</label>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   value="{{ old('email') }}"
                                   class="mt-2 block w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-100"
                                   required>
                        </div>

                        <div>
                            <label for="kontak_person" class="text-sm font-medium text-slate-700">Kontak Person</label>
                            <input type="text"
                                   name="kontak_person"
                                   id="kontak_person"
                                   value="{{ old('kontak_person') }}"
                                   class="mt-2 block w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-100"
                                   required>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 pt-6 border-t border-slate-200">
                        <a href="{{ route('admin.suplier.index') }}" class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 font-medium">
                            Batal
                        </a>
                        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium">
                            Simpan Supplier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection