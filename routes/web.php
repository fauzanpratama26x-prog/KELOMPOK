<?php

use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\PermintaanStokController;
use App\Http\Controllers\Admin\SuplierController;
use App\Http\Controllers\GeraiController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isAdmin()) return redirect()->route('admin.dashboard');
        if ($user->isGudang()) return redirect()->route('gudang.index');
        if ($user->isGerai()) return redirect()->route('gerai.index');
        abort(403, 'Role tidak valid');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [PermintaanStokController::class, 'index'])->name('dashboard');
    Route::post('/permintaan/{permintaan}/approve', [PermintaanStokController::class, 'approve'])->name('permintaan.approve');
    Route::post('/permintaan/{permintaan}/reject', [PermintaanStokController::class, 'reject'])->name('permintaan.reject');
    
    Route::get('/barang-masuk', [PermintaanStokController::class, 'barangMasukIndex'])->name('barang-masuk.index');
    Route::post('/barang-masuk/{permintaan}/approve', [PermintaanStokController::class, 'approveBarangMasuk'])->name('barang-masuk.approve');
    Route::post('/barang-masuk/{permintaan}/reject', [PermintaanStokController::class, 'rejectBarangMasuk'])->name('barang-masuk.reject');
    
    
    Route::get('barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('barang/{barang}', [BarangController::class, 'show'])->name('barang.show');
    
    Route::resource('suplier', SuplierController::class);
});


Route::middleware(['auth', 'role:gudang'])->prefix('gudang')->name('gudang.')->group(function () {
    Route::get('/', [GudangController::class, 'index'])->name('index');
    Route::get('/barang-masuk', [GudangController::class, 'index'])->name('barang-masuk.index');
    Route::post('/permintaan-barang-masuk', [GudangController::class, 'storeIncomingRequest'])->name('permintaan-barang-masuk.store');
    Route::post('/barang-masuk', [GudangController::class, 'storeIncoming'])->name('barang-masuk.store');
    Route::post('/permintaan/{permintaan}/ship', [GudangController::class, 'ship'])->name('permintaan.ship');
    Route::post('/permintaan/{permintaan}/receive', [GudangController::class, 'receive'])->name('permintaan.receive');
});


Route::middleware(['auth', 'role:gerai'])->prefix('gerai')->name('gerai.')->group(function () {
    Route::get('/', [GeraiController::class, 'index'])->name('index');
    Route::post('/permintaan', [GeraiController::class, 'storeRequest'])->name('permintaan.store');
    Route::get('/transaksi', [GeraiController::class, 'transaksiIndex'])->name('transaksi.index');
    Route::post('/transaksi', [GeraiController::class, 'storeTransaksi'])->name('transaksi.store');
});

require __DIR__.'/auth.php';
