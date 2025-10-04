<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataMataKuliah = MataKuliah::all();
        return view('matakuliah.index', compact('dataMataKuliah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $dosen = User::where('role', 'dosen')->orderBy('name')->get();

        return view('matakuliah.create', compact('dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_mk' => 'required|string|max:10|unique:mata_kuliah,kode_mk',
            'nama_mk' => 'required|string|max:50',
            'sks' => 'required|integer|min:1|max:6',
            'dosen_id' => 'required|exists:users,id',
        ], [
            // Custom Messages
            'kode_mk.required' => 'Kode Mata Kuliah wajib diisi.',
            'kode_mk.max' => 'Kode Mata Kuliah tidak boleh lebih dari 10 karakter.',
            'kode_mk.unique' => 'Kode Mata Kuliah sudah terdaftar, gunakan kode lain.',
            'nama_mk.required' => 'Nama Mata Kuliah wajib diisi.',
            'nama_mk.max' => 'Nama Mata Kuliah tidak boleh lebih dari 50 karakter.',
            'sks.required' => 'SKS wajib diisi.',
            'sks.integer' => 'SKS harus berupa angka.',
            'sks.min' => 'SKS minimal 1.',
            'sks.max' => 'SKS maksimal 3.',
            'dosen_id.required' => 'Dosen wajib diisi.',
            'dosen_id.integer' => 'Dosen harus berupa angka.',
            'dosen_id.min' => 'Id Dosen minimal 1.',
            'dosen_id.max' => 'ID Dosen maksimal 14.',
        ]);

        MataKuliah::create($validated);
        return redirect()->route('mataKuliah')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        $dosen = User::where('role', 'dosen')->orderBy('name')->get();
        return view('matakuliah.edit', compact('mataKuliah', 'dosen'));
    }

    public function update(Request $request, string $id){

        $mataKuliah = MataKuliah::findOrFail($id);

        $validated = $request->validate([
            'kode_mk' => 'required|string|max:10|unique:mata_kuliah,kode_mk,' . $mataKuliah->id,
            'nama_mk' => 'required|string|max:50',
            'sks' => 'required|integer|min:1|max:6',
            'dosen_id' => 'required|exists:users,id',
        ], [
            // Custom Messages
            'kode_mk.required' => 'Kode Mata Kuliah wajib diisi.',
            'kode_mk.max' => 'Kode Mata Kuliah tidak boleh lebih dari 10 karakter.',
            'kode_mk.unique' => 'Kode Mata Kuliah sudah terdaftar, gunakan kode lain.',
            'nama_mk.required' => 'Nama Mata Kuliah wajib diisi.',
            'nama_mk.max' => 'Nama Mata Kuliah tidak boleh lebih dari 50 karakter.',
            'sks.required' => 'SKS wajib diisi.',
            'sks.integer' => 'SKS harus berupa angka.',
            'sks.min' => 'SKS minimal 1.',
            'sks.max' => 'SKS maksimal 6.',
        ]);

        $mataKuliah->update($validated);

        return redirect()->route('mataKuliah')->with('success', 'Data Mata Kuliah Berhasil diperbarui');
    }
     function destroy(string $id){

            $mataKuliah = MataKuliah::findOrFail($id);
            $mataKuliah->delete();

            return redirect()->route('mataKuliah')->with('success','Data berhasil di hapus');
        }
}
