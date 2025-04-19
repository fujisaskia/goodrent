<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:8|confirmed', // password_confirmation harus dikirim dari frontend
            'no_telp' => 'required|string|max:20|unique:users', // No. telepon harus dikirim dari frontend
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.max' => 'Nama tidak boleh lebih dari 50 karakter',
            'email.required' => 'Email wajib diisi',
            'email.max' => 'Email tidak boleh lebih dari 50 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password dan konfirmasi password harus sama',
            'no_telp.required' => 'No. telepon wajib diisi',
            'no_telp.max' => 'No. telepon tidak boleh lebih dari 20 karakter',
            'no_telp.unique' => 'No. telepon sudah terdaftar',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
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

        return redirect()->route('lihat.produk')->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name . '!');
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

        if ($user->status_pelanggan === 'Banned') {
            Auth::logout();
            return redirect()->route('login')->withErrors('Akun Anda telah diblokir secara permanen.');
        }

        if ($user->status_pelanggan === 'Suspended') {
            Auth::logout();
            return redirect()->route('login')->withErrors('Akun Anda telah ditangguhkan oleh admin.');
        }

        // Update status user menjadi 'Online'
        // $user->update([
        //     'status' => 'Online',
        //     'last_online_at' => now(),
        // ]);

        $user->status = 'Online';
        $user->last_online_at = now();
        $user->save();

        // Cek role dengan Spatie
        if ($user->hasRole('superadmin') || $user->hasRole('admin')) {
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        } elseif ($user->hasRole('pelanggan')) {
            return redirect()->route('lihat.produk')->with('success', 'Login berhasil!');
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
            $user->status = 'Offline';
            $user->last_online_at = now();
            $user->save();
        }

        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil keluar.');
    }

    public function forgotPasswordPage()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.exists' => 'Email tidak terdaftar',
        ]);

        $otp = rand(100000, 999999);
        $email = $request->email;

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => $otp,
                'created_at' => Carbon::now(),
            ]
        );

        Mail::raw("Kode OTP reset password Anda adalah: $otp", function ($message) use ($email) {
            $message->to($email)->subject('Kode OTP Reset Password');
        });

        return redirect()->route('verify.otp.page')->with('email', $email);
    }

    public function verifyOtpPage(Request $request)
    {
        $email = session('email');
        return view('auth.verify-otp', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
            'email' => 'required|email',
        ], [
            'otp.required' => 'Kode OTP wajib diisi',
            'otp.numeric' => 'Kode OTP harus berupa angka',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
        ]);

        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$record) {
            return back()->withErrors(['otp' => 'Data reset tidak ditemukan']);
        }

        $isExpired = Carbon::parse($record->created_at)->addMinutes(10)->isPast(); // OTP 10 menit

        if ($isExpired) {
            return back()->withErrors(['otp' => 'Kode OTP telah kedaluwarsa']);
        }

        if ($record->token != $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah']);
        }

        // Simpan email di session untuk halaman reset password
        session(['reset_email' => $request->email]);

        return redirect()->route('password.reset.page');
    }

    public function resetPasswordPage()
    {
        $email = session('reset_email');
        return view('auth.reset-password', compact('email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.exists' => 'Email tidak terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        DB::table('users')->where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        session()->forget('reset_email');

        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login.');
    }
}
