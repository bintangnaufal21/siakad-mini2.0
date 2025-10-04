<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalKuliahController;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// ROUTE MAHASISWA
Route::get('/data-mahasiswa', [MahasiswaController::class, 'index'])->name('dataMahasiswa');
Route::get('/data-mahasiswa/create', [MahasiswaController::class, 'create'])->name('createMahasiswa');
Route::post('/data-mahasiswa/store', [MahasiswaController::class, 'store'])->name('storeMahasiswa');
Route::get('/data-mahasiswa/edit/{id}', [MahasiswaController::class, 'edit'])->name('editMahasiswa');
Route::put('/data-mahasiswa/update/{id}', [MahasiswaController::class, 'update'])->name('updateMahasiswa');
Route::delete('/data-mahasiswa/delete/{id}', [MahasiswaController::class, 'destroy'])->name('deleteMahasiswa');

//ROUTE MATA KULIAH
Route::get('/mata-kuliah', [MataKuliahController::class, 'index'])->name('mataKuliah');
Route::get('/mata-kuliah/create', [MataKuliahController::class, 'create'])->name('createMataKuliah');
Route::post('/mata-kuliah/store', [MataKuliahController::class, 'store'])->name('storeMataKuliah');
Route::get('/mata-kuliah/edit{id}', [MataKuliahController::class, 'edit'])->name('editMataKuliah');
Route::put('/mata-kuliah/update{id}', [MataKuliahController::class, 'update'])->name('updateMataKuliah');
Route::delete('/mata-kuliah/delete{id}', [MataKuliahController::class, 'destroy'])->name('deleteMataKuliah');

//ROUTE DATA DOSEN
Route::get('/data-dosen', [DosenController::class, 'index'])-> name('dataDosen');
Route::get('/data-dosen/create', [DosenController::class, 'create'])-> name('createDosen');
Route::post('/data-dosen/store', [DosenController::class, 'store'])-> name('storeDosen');
Route::get('/data-dosen/edit{id}', [DosenController::class, 'edit'])-> name('editDosen');
Route::put('/data-dosen/update{id}', [DosenController::class, 'update'])-> name('updateDosen');
Route::delete('/data-dosen/delete{id}', [DosenController::class, 'destroy'])-> name('deleteDosen');

//ROUTE JADWAL KULIAH
Route::get('/jadwal-kuliah', [JadwalKuliahController::class, 'index'])-> name('dataJadwalKuliah');
Route::get('/jadwal-kuliah/create', [JadwalKuliahController::class, 'create'])-> name('createJadwalKuliah');
Route::post('/jadwal-kuliah/store', [JadwalKuliahController::class, 'store'])-> name('storeJadwalKuliah');
Route::get('/jadwal-kuliah/edit{id}', [JadwalKuliahController::class, 'edit'])-> name('editJadwalKuliah');
Route::put('/jadwal-kuliah/update{id}', [JadwalKuliahController::class, 'update'])-> name('updateJadwalKuliah');
Route::delete('/jadwal-kuliah/delete{id}', [JadwalKuliahController::class, 'destroy'])-> name('deleteJadwalKuliah');


Route::get('/nilai', function () {
    return view('nilai');
})->name('dataNilaiMahasiswa');



