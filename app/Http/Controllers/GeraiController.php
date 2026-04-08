<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gerai;
use App\Models\GeraiBarangStok;
use App\Models\PermintaanStok;
use App\Models\Transaksi;

class GeraiController extends Controller
{
    protected function resolveGerai(): Gerai
    {
        $user = auth()->user();

        $gerai = Gerai::where('nama', $user->name)
            ->orWhere('nama', 'like', "%{$user->name}%")
            ->first();

        if (! $gerai) {
            $gerai = Gerai::first();
        }

        if (! $gerai) {
            abort(404, 'Data Gerai belum tersedia. Silakan jalankan seeder atau buat data Gerai terlebih dahulu.');
        }

        return $gerai;
    }

    public function index()
    {
        $gerai = $this->resolveGerai();

        $barangs = Barang::all();
        $permintaans = PermintaanStok::with(['gerai', 'barang'])
            ->where('gerai_id', $gerai->id_gerai)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('gerai.index', compact('barangs', 'permintaans'));
    }

    public function storeRequest()
    {
        $gerai = $this->resolveGerai();

        request()->validate([
            'barang' => 'required|exists:barangs,id_barang',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
        ]);

        PermintaanStok::create([
            'gerai_id' => $gerai->id_gerai,
            'barang_id' => request('barang'),
            'quantity' => request('quantity'),
            'notes' => request('notes') ?? '',
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permintaan stok dikirim ke admin.');
    }

    public function transaksiIndex()
    {
        $gerai = $this->resolveGerai();

        $barangs = Barang::all();
        $transaksis = Transaksi::with(['gerai', 'barang', 'user'])
            ->where('gerai_id', $gerai->id_gerai)
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('gerai.transaksi', compact('transaksis', 'barangs'));
    }

    public function storeTransaksi()
    {
        $gerai = $this->resolveGerai();

        request()->validate([
            'barang' => 'required|exists:barangs,id_barang',
            'quantity' => 'required|integer|min:1',
        ]);

        $stock = GeraiBarangStok::where([
            'gerai_id' => $gerai->id_gerai,
            'barang_id' => request('barang'),
        ])->first();

        if (! $stock || $stock->stok < request('quantity')) {
            return back()->with('error', 'Stok tidak cukup untuk transaksi.');
        }

        $stock->decrement('stok', request('quantity'));
        $barang = Barang::findOrFail(request('barang'));

        Transaksi::create([
            'gerai_id' => $gerai->id_gerai,
            'barang_id' => request('barang'),
            'quantity' => request('quantity'),
            'total' => request('quantity') * $barang->harga,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Transaksi berhasil dicatat.');
    }
}
