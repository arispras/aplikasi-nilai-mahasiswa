<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;

// Auto redirect to login if not authenticated
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Jurusan
    Route::resource('jurusan', JurusanController::class);

    // Mahasiswa
    Route::resource('mahasiswa', MahasiswaController::class);

    // Mata Kuliah
    Route::resource('mata-kuliah', MataKuliahController::class);

    // Nilai
    Route::resource('nilai', NilaiController::class);

    // AJAX Routes
    // Route::get('/get-mata-kuliah/{jurusan_id}', [MataKuliahController::class, 'getByJurusan'])->name('get.mata.kuliah');
    // Route::get('/get-mata-kuliah-by-mahasiswa/{mahasiswa_id}', [NilaiController::class, 'getMataKuliahByMahasiswa'])->name('get.mata.kuliah.by.mahasiswa');
    // AJAX Routes
    Route::get('/get-mata-kuliah/{jurusan_id}', [MataKuliahController::class, 'getByJurusan'])->name('get.mata.kuliah');
    Route::get('/get-mata-kuliah-by-mahasiswa/{mahasiswa_id}', [NilaiController::class, 'getMataKuliahByMahasiswa'])->name('get.mata.kuliah.by.mahasiswa');

    // Laporan
    Route::prefix('laporan')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/mahasiswa', [LaporanController::class, 'mahasiswa'])->name('laporan.mahasiswa');
        Route::get('/mahasiswa/pdf', [LaporanController::class, 'mahasiswaPDF'])->name('laporan.mahasiswa.pdf');
        Route::get('/nilai', [LaporanController::class, 'nilai'])->name('laporan.nilai');
        Route::get('/nilai/pdf', [LaporanController::class, 'nilaiPDF'])->name('laporan.nilai.pdf');
        Route::get('/mata-kuliah', [LaporanController::class, 'mataKuliah'])->name('laporan.mata_kuliah');
        Route::get('/mata-kuliah/pdf', [LaporanController::class, 'mataKuliahPDF'])->name('laporan.mata_kuliah.pdf');
        Route::get('/transkrip/{mahasiswa}', [LaporanController::class, 'transkrip'])->name('laporan.transkrip');
        Route::get('/transkrip/{mahasiswa}/pdf', [LaporanController::class, 'transkripPDF'])->name('laporan.transkrip.pdf');
        Route::get('/krs/{mahasiswa}', [LaporanController::class, 'krs'])->name('laporan.krs');
        Route::get('/krs/{mahasiswa}/pdf', [LaporanController::class, 'krsPDF'])->name('laporan.krs.pdf');
    });

    // Users (hanya admin)
    Route::middleware(['admin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
