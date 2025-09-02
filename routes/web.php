<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [BorrowingController::class, 'index'])->name('dashboard');
    Route::get('/pinjam/{barangs}', [BorrowingController::class, 'create'])->name('pinjam.create');
    Route::post('/pinjam', [BorrowingController::class, 'store'])->name('pinjam.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('barang', AdminController::class);
    Route::resource('users', UserController::class);
    Route::post('/peminjaman/{peminjaman}/approve', [AdminController::class, 'approve'])->name('peminjaman.approve');
    Route::post('/peminjaman/{peminjaman}/return', [AdminController::class, 'return'])->name('peminjaman.return');
});

require __DIR__.'/auth.php';
