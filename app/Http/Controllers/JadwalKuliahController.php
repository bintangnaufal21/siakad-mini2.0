<?php

namespace App\Http\Controllers;

use App\Models\JadwalKuliah;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JadwalKuliahController extends Controller
{
    public function index()
    {
        $dataJadwalKuliah = JadwalKuliah::with('mataKuliah')->get();
        return view('jadwal.index', compact('dataJadwalKuliah'));
    }


    public function create()
    {
            $dataMataKuliah = MataKuliah::all();
            return view('jadwal.create', compact('dataMataKuliah'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'ruang' => 'required|string|max:225',
        ], [
            // Custom Messages
            'mata_kuliah_id.required' => 'Mata kuliah wajib diisi.',
            'mata_kuliah_id.exists' => 'Mata kuliah tidak valid.',
            'hari.required' => 'Hari wajib diisi.',
            'hari.in' => 'Hari tidak valid.',
            'waktu_mulai.required' => 'Waktu mulai wajib diisi.',
            'waktu_mulai.date_format' => 'Format waktu mulai tidak valid. Gunakan format HH:MM (24 jam).',
            'waktu_selesai.required' => 'Waktu selesai wajib diisi.',
            'waktu_selesai.date_format' => 'Format waktu selesai tidak valid. Gunakan format HH:MM (24 jam).',
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai.',
            'ruang.required' => 'Ruang wajib diisi.',
            'ruang.max' => 'Ruang tidak boleh lebih dari 60 karakter.',
        ]);



        JadwalKuliah::create($validated);
        return redirect()->route('dataJadwalKuliah')->with('success', 'jadwal berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $dataJadwalKuliah = JadwalKuliah::findOrFail($id);
        $dataMataKuliah = MataKuliah::all();
       /*  dd($dataJadwalKuliah); */
        return view('jadwal.edit', compact('dataJadwalKuliah', 'dataMataKuliah'));
    }

    public function update(Request $request, string $id)
    {
        $jadwalKuliah = JadwalKuliah::findOrFail($id);

        $validated = $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'ruang' => 'required|string|max:225',
        ], [
            // Custom Messages
            'mata_kuliah_id.required' => 'Mata kuliah wajib diisi.',
            'mata_kuliah_id.exists' => 'Mata kuliah tidak valid.',
            'hari.required' => 'Hari wajib diisi.',
            'hari.in' => 'Hari tidak valid.',
            'waktu_mulai.required' => 'Waktu mulai wajib diisi.',
            'waktu_mulai.date_format' => 'Format waktu mulai tidak valid. Gunakan format HH:MM (24 jam).',
            'waktu_selesai.required' => 'Waktu selesai wajib diisi.',
            'waktu_selesai.date_format' => 'Format waktu selesai tidak valid. Gunakan format HH:MM (24 jam).',
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai.',
            'ruang.required' => 'Ruang wajib diisi.',
            'ruang.max' => 'Ruang tidak boleh lebih dari 60 karakter.',
        ]);

        $jadwalKuliah->update($validated);
        return redirect()->route('dataJadwalKuliah')->with('success', 'Jadwal kuliah berhasil diperbarui.');
    }
    public function destroy(string $id)
    {
        $jadwalKuliah = JadwalKuliah::findOrFail($id);
        $jadwalKuliah->delete();
        return redirect()->route('dataJadwalKuliah')->with('success', 'Jadwal kuliah berhasil dihapus.');
    }

}
