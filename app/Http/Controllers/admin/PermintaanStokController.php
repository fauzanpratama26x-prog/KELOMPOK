<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermintaanStok;
use App\Models\PermintaanBarangMasuk;

class PermintaanStokController extends Controller
{
    public function index()
    {
        $permintaans = PermintaanStok::with(['gerai', 'barang', 'admin'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.permintaan.index', compact('permintaans'));
    }

    public function approve(PermintaanStok $permintaan)
    {
        if ($permintaan->status !== 'pending') {
            return back()->with('error', 'Permintaan sudah tidak dapat diproses.');
        }

        $permintaan->update([
            'status' => 'approved',
            'admin_id' => auth()->id(),
        ]);

        return back()->with('success', 'Permintaan stok berhasil disetujui.');
    }

    public function reject(PermintaanStok $permintaan)
    {
        if ($permintaan->status !== 'pending') {
            return back()->with('error', 'Permintaan sudah tidak dapat diproses.');
        }

        $permintaan->update([
            'status' => 'rejected',
            'admin_id' => auth()->id(),
        ]);

        return back()->with('success', 'Permintaan stok ditolak.');
    }

    public function barangMasukIndex()
    {
        $permintaanMasuks = PermintaanBarangMasuk::with(['barang', 'user'])
            ->where('status', 'pending')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.barang-masuk.index', compact('permintaanMasuks'));
    }

    public function approveBarangMasuk(PermintaanBarangMasuk $permintaan)
    {
        if ($permintaan->status !== 'pending') {
            return back()->with('error', 'Permintaan sudah tidak dapat diproses.');
        }

        if ($permintaan->nama_barang_baru) {
            $validCategories = ['Makanan', 'Kosmetik', 'Aksesoris'];
            if (!in_array($permintaan->kategori_baru, $validCategories, true)) {
                return back()->with('error', 'Kategori barang baru tidak valid. Pilih salah satu: Makanan, Kosmetik, Aksesoris.');
            }
        }

        $permintaan->update([
            'status' => 'approved',
            'admin_id' => auth()->id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Permintaan barang masuk disetujui.');
    }

    public function rejectBarangMasuk(PermintaanBarangMasuk $permintaan)
    {
        if ($permintaan->status !== 'pending') {
            return back()->with('error', 'Permintaan sudah tidak dapat diproses.');
        }

        $permintaan->update([
            'status' => 'rejected',
            'admin_id' => auth()->id(),
        ]);

        return back()->with('success', 'Permintaan barang masuk ditolak.');
    }
}
