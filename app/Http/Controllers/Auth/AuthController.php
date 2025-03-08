<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //register page
    public function registerPage()
    {
        return view('auth.register');
    }

    // REGISTER
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // password_confirmation harus dikirim dari frontend
            'no_telp' => 'required|string|max:20|unique:users', // No. telepon harus dikirim dari frontend
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password dan konfirmasi password harus sama',
            'no_telp.required' => 'No. telepon wajib diisi',
            'no_telp.unique' => 'No. telepon sudah terdaftar',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_telp' => $request->no_telp,
            'image' => 'Dummy.png',
            'status' => 'Offline',
            'status_pelanggan' => 'Aktif',
        ]);

        $user->assignRole('pelanggan');
        Auth::login($user);

        // Update status user menjadi 'online' dan waktu online
        $user->status = 'Online';
        $user->last_online_at = now();
        $user->save();

        return redirect()->route('user.dashboard')->with('success', 'Registrasi berhasil!');
    }

    // LOGIN PAGE
    public function loginPage()
    {
        return view('auth.login');
    }

    // LOGIN
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return redirect()->route('login')->withErrors('Email atau password salah!');
        }

        $user = Auth::user();

        // Cek apakah user diblokir atau ditangguhkan
        if ($user->status_pelanggan === 'Banned') {
            Auth::logout();
            return redirect()->route('login')->withErrors('Akun Anda telah diblokir secara permanen.');
        }

        if ($user->status_pelanggan === 'Suspended') {
            Auth::logout();
            return redirect()->route('login')->withErrors('Akun Anda telah ditangguhkan oleh admin.');
        }

        // Update status user menjadi 'Online'
        $user->update([
            'status' => 'Online',
            'last_online_at' => now(),
        ]);

        // Cek role dengan Spatie
        if ($user->hasRole('superadmin') || $user->hasRole('admin')) {
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        } elseif ($user->hasRole('pelanggan')) {
            return redirect()->route('user.dashboard')->with('success', 'Login berhasil!');
        }

        // Jika role tidak valid, logout user
        Auth::logout();
        return redirect()->route('login')->withErrors('Anda tidak memiliki akses!');
    }

    // LOGOUT
    public function logout()
    {
        $user = Auth::user();
        if ($user) {
            $user->update([
                'status' => 'Offline',
                'last_online_at' => now(),
            ]);
        }

        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil keluar.');
    }

    // lupa password page
    public function forgotPasswordPage()
    {
        return view('auth.forgot-password');
    }

    // LUPA PASSWORD
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.exists' => 'Email tidak ditemukan',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Link reset password telah dikirim ke email Anda.')
            : back()->withErrors('Gagal mengirim link reset password.');
    }

    public function resetPasswordPage($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.exists' => 'Email tidak ditemukan',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password dan konfirmasi password harus sama',
        ]);

        // Reset password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password berhasil direset! Silakan login.')
            : back()->withErrors(['email' => 'Token tidak valid atau sudah kadaluarsa.']);
    }
}
