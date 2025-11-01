<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard')->with('success', 'Berhasil login sebagai Admin.');
            } elseif (Auth::user()->role === 'dosen') {
                return redirect()->route('dashboard')->with('success', 'Berhasil login sebagai Dosen.');
            } else {
                return redirect()->route('dashboard')->with('success', 'Berhasil login sebagai Mahasiswa.');
            }
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }

    // =======================================================
    // ========== BAGIAN LUPA PASSWORD & RESET PASSWORD ======
    // =======================================================

    /**
     * Tampilkan form lupa password
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgotPassword');
    }

    /**
     * Kirim link reset password ke email
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return match ($status) {
            Password::RESET_LINK_SENT =>
            back()->with('success', 'Link reset password telah dikirim ke email kamu.'),
            Password::INVALID_USER =>
            back()->withErrors(['email' => 'Email tidak terdaftar dalam sistem.']),
            default =>
            back()->withErrors(['email' => 'Terjadi kesalahan saat mengirim link reset. Coba lagi nanti.']),
        };
    }

    /**
     * Tampilkan form reset password
     */
    public function showResetPasswordForm(Request $request, $token)
    {
        // Jika ada email di query string, otomatis tampil di form
        $email = $request->query('email', old('email'));
        return view('auth.resetPassword', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    /**
     * Simpan password baru
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                Auth::login($user);
            }
        );

        return match ($status) {
            Password::PASSWORD_RESET =>
            redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login kembali.'),
            Password::INVALID_TOKEN =>
            back()->withErrors(['email' => 'Token reset tidak valid atau sudah kadaluarsa.']),
            Password::INVALID_USER =>
            back()->withErrors(['email' => 'Email tidak ditemukan.']),
            default =>
            back()->withErrors(['email' => 'Terjadi kesalahan, coba lagi nanti.']),
        };
    }
}
