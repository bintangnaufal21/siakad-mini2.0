<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // hanya ambil user dengan role mahasiswa
        $dataMahasiswa = User::where('role', 'mahasiswa')->orderBy('npm')->get();
        return view('mahasiswa.index', compact('dataMahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:40',
            'npm' => 'required|string|max:20|unique:users,npm',
            'email' => 'required|email|unique:users,email',
            'no_telepon' => 'required|string|max:12',
            'password' => 'required|string|min:6|confirmed',
        ], [
            // Custom Messages
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 40 karakter.',
            'npm.required' => 'NPM wajib diisi.',
            'npm.string' => 'NPM harus berupa angka.',
            'npm.max' => 'Npm tidak boleh lebih dari 20 karakter.',
            'npm.unique' => 'NPM sudah terdaftar, gunakan NPM lain.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar, gunakan email lain.',
            'no_telepon.required' => 'No telepon wajib diisi.',
            'no_telepon.max' => 'No telepon maksimal 12 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'mahasiswa'; // set role otomatis

        User::create($validated);

        return redirect()->route('dataMahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, string $id)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:40',
            'npm' => 'required|string|max:12|unique:users,npm,' . $mahasiswa->id,
            'email' => 'required|email|unique:users,email,' . $mahasiswa->id,
            'no_telepon' => 'required|string|max:12',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            // Custom Messages
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 40 karakter.',
            'npm.required' => 'NPM wajib diisi.',
            'npm.string' => 'NPM harus berupa angka.',
            'npm.max' => 'Npm tidak boleh lebih dari 20 karakter.',
            'npm.unique' => 'NPM sudah terdaftar, gunakan NPM lain.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar, gunakan email lain.',
            'no_telepon.required' => 'No telepon wajib diisi.',
            'no_telepon.max' => 'No telepon maksimal 12 karakter.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Jika password diisi, hash dan update
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            // Jika password kosong, hapus dari array validasi agar tidak diupdate
            unset($validated['password']);
        }

        $mahasiswa->update($validated);

        return redirect()->route('dataMahasiswa')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('dataMahasiswa')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
