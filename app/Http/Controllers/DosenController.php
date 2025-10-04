<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as Dosen;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    //
    public function index()
    {
        $dataDosen = Dosen::where('role', 'dosen')->orderBy('npm')->get();
        return view('dosen.index', compact('dataDosen'));
    }

    public function create()
    {
        return view('dosen.create');
    }

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
        $validated['role'] = 'dosen'; // set role otomatis
        Dosen::create($validated);

        return redirect()->route('dataDosen')->with('success', 'Dosen berhasil ditambahkan.');

    }

    public function edit(string $id){
        $dosen = User::where('role', 'dosen')->findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, string $id)
    {
        $dosen = User::where('role', 'dosen')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:40',
            'npm' => 'required|string|max:12|unique:users,npm,' . $dosen->id,
            'email' => 'required|email|unique:users,email,' . $dosen->id,
            'no_telepon' => 'required|string|max:12',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            // Custom Messages
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 40 karakter.',
            'npm.required' => 'NIP wajib diisi.',
            'npm.string' => 'NIP harus berupa angka.',
            'npm.max' => 'NIP tidak boleh lebih dari 20 karakter.',
            'npm.unique' => 'NIP sudah terdaftar, gunakan NIP lain.',
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

        $dosen->update($validated);

        return redirect()->route('dataDosen')->with('success', 'Data Dosen berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $dosen = User::where('role', 'dosen')->findOrFail($id);
        $dosen->delete();

        return redirect()->route('dataDosen')->with('success', 'Dosen berhasil dihapus.');
    }
}
