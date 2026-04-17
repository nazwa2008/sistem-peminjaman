<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Data Alat (CRUD) - Admin & Petugas can manage, Peminjam can only view? 
    // Usually Peminjam views in 'Borrow' page.
    Route::middleware(['role:admin'])->name('admin.')->group(function () {
        Route::resource('petugas', PetugasController::class)->parameters([
            'petugas' => 'petugas'
        ]);
        Route::resource('users', \App\Http\Controllers\PetugasController::class)->parameters([
            'users' => 'petugas'
        ]); // Alias jika diperlukan
    });

    Route::middleware(['role:admin,petugas'])->name('admin.')->group(function () {
        Route::get('alat', [AlatController::class, 'index'])->name('alat.index');
        
        Route::middleware(['role:admin'])->group(function () {
            Route::resource('alat', AlatController::class)->except(['index']);
            Route::resource('categories', CategoryController::class);
        });
        
        Route::get('/persetujuan', [PeminjamanController::class, 'persetujuan'])->name('persetujuan.index');
        Route::post('/persetujuan/{peminjaman}/approve', [PeminjamanController::class, 'approve'])->name('persetujuan.approve');
        Route::post('/persetujuan/{peminjaman}/reject', [PeminjamanController::class, 'approve'])->name('persetujuan.reject');
        
        Route::get('/pengembalian', [PeminjamanController::class, 'pengembalian'])->name('pengembalian.index');
        Route::post('/pengembalian/{detail}/process', [PeminjamanController::class, 'processReturn'])->name('pengembalian.process');
        
        Route::get('/laporan', [PeminjamanController::class, 'laporan'])->name('laporan.index');
        Route::post('/laporan/{detail}/send-email', [PeminjamanController::class, 'kirimEmail'])->name('laporan.sendEmail');
        Route::get('/pengingat', [PeminjamanController::class, 'pengingat'])->name('pengingat.index');
    });

    // Peminjaman (For All Roles)
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/struk/{id}', [PeminjamanController::class, 'cetakStruk'])->name('struk.cetak');
    
    // Peminjam only actions
    Route::middleware(['role:peminjam'])->group(function () {
        Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
        Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    });
});

require __DIR__.'/auth.php';
