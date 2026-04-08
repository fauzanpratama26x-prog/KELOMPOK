<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\GeraiBarangStok;
use App\Models\PermintaanStok;
use App\Models\PermintaanBarangMasuk;
use App\Models\Suplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GudangController extends Controller
{
    public function index()
    {
        $requests = PermintaanStok::with(['gerai', 'barang'])
            ->whereIn('status', ['approved', 'shipped'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $barangs = Barang::all();
        $supliers = Suplier::all();
        $permintaanMasuks = PermintaanBarangMasuk::with(['barang', 'admin'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('gudang.index', compact('requests', 'barangs', 'supliers', 'permintaanMasuks'));
    }

    public function storeIncomingRequest()
    {
        try {
            \Log::info('Gudang storeIncomingRequest called', request()->all());

            $jenisPermintaan = request('jenis_permintaan');

            if ($jenisPermintaan === 'existing') {
                request()->validate([
                    'barang' => 'required|exists:barangs,id_barang',
                    'quantity' => 'required|integer|min:1',
                    'notes' => 'nullable|string|max:500',
                ]);

                PermintaanBarangMasuk::create([
                    'barang_id' => request('barang'),
                    'quantity' => request('quantity'),
                    'notes' => request('notes') ?? '',
                    'status' => 'pending',
                    'user_id' => auth()->id(),
                ]);
            } elseif ($jenisPermintaan === 'new') {
                request()->validate([
                    'nama_barang_baru' => 'required|string|max:255',
                    'kategori_baru' => 'required|in:Makanan,Kosmetik,Aksesoris',
                    'harga_baru' => 'required|numeric|min:0',
                    'suplier_baru' => 'required|exists:supliers,id_suplier',
                    'quantity' => 'required|integer|min:1',
                    'notes' => 'nullable|string|max:500',
                ]);

                PermintaanBarangMasuk::create([
                    'nama_barang_baru' => request('nama_barang_baru'),
                    'kategori_baru' => request('kategori_baru'),
                    'harga_baru' => request('harga_baru'),
                    'suplier_baru' => request('suplier_baru'),
                    'quantity' => request('quantity'),
                    'notes' => request('notes') ?? '',
                    'status' => 'pending',
                    'user_id' => auth()->id(),
                ]);
            } else {
                \Log::error('Invalid jenis_permintaan', ['jenis' => $jenisPermintaan]);
                return back()->with('error', 'Jenis permintaan tidak valid.');
            }

            return back()->with('success', 'Permintaan barang masuk telah dikirim ke admin untuk approval.');
        } catch (\Exception $e) {
            \Log::error('Error in storeIncomingRequest', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function storeIncoming()
    {
        $permintaan = PermintaanBarangMasuk::findOrFail(request('permintaan_id'));

        if ($permintaan->status !== 'approved') {
            return back()->with('error', 'Hanya permintaan yang disetujui admin yang bisa diproses.');
        }

        if ($permintaan->user_id !== auth()->id()) {
            return back()->with('error', 'Anda tidak memiliki akses untuk memproses permintaan ini.');
        }

        $validCategories = ['Makanan', 'Kosmetik', 'Aksesoris'];
        if ($permintaan->nama_barang_baru && !in_array($permintaan->kategori_baru, $validCategories, true)) {
            return back()->with('error', 'Kategori barang baru tidak valid. Pilih salah satu: Makanan, Kosmetik, Aksesoris.');
        }

        DB::transaction(function () use ($permintaan) {
            if ($permintaan->nama_barang_baru) {
                
                $idBarang = Str::upper('B' . Str::random(8));
                while (Barang::where('id_barang', $idBarang)->exists()) {
                    $idBarang = Str::upper('B' . Str::random(8));
                }

                $barang = Barang::create([
                    'id_barang' => $idBarang,
                    'nama_barang' => $permintaan->nama_barang_baru,
                    'kategori' => $permintaan->kategori_baru,
                    'harga' => $permintaan->harga_baru,
                    'suplier' => $permintaan->suplier_baru,
                    'stok' => $permintaan->quantity,
                ]);
            } else {
                
                $barang = $permintaan->barang;
                $barang->increment('stok', $permintaan->quantity);
            }

            $permintaan->update(['status' => 'completed']);
        });

        return back()->with('success', 'Barang masuk berhasil dicatat. Stok gudang telah diperbarui.');
    }

    public function ship(PermintaanStok $permintaan)
    {
        if ($permintaan->status !== 'approved') {
            return back()->with('error', 'Hanya permintaan yang disetujui admin yang bisa dikirim.');
        }

        $barang = $permintaan->barang;

        if (!$barang || $barang->stok < $permintaan->quantity) {
            return back()->with('error', 'Stok gudang tidak mencukupi.');
        }

        $barang->decrement('stok', $permintaan->quantity);
        
        $geraiStok = GeraiBarangStok::where([
            'gerai_id' => $permintaan->gerai_id,
            'barang_id' => $permintaan->barang_id,
        ])->first();

        if ($geraiStok) {
            $geraiStok->increment('stok', $permintaan->quantity);
        } else {
            GeraiBarangStok::create([
                'gerai_id' => $permintaan->gerai_id,
                'barang_id' => $permintaan->barang_id,
                'stok' => $permintaan->quantity,
            ]);
        }

        $permintaan->update([
            'status' => 'shipped',
            'shipped_at' => now(),
        ]);

        return back()->with('success', 'Barang berhasil dikirim ke gerai.');
    }

    public function receive(PermintaanStok $permintaan)
    {
        if ($permintaan->status !== 'shipped') {
            return back()->with('error', 'Hanya permintaan yang sudah dikirim yang bisa dikonfirmasi.');
        }

        $permintaan->update([
            'status' => 'received',
            'received_at' => now(),
        ]);

        return back()->with('success', 'Konfirmasi penerimaan berhasil.');
    }
}
