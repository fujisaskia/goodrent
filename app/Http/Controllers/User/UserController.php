<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'pelanggan'); // Sesuaikan dengan nama role di database
        })->get();

        return view('admin.kelola-user.index', compact('users'));
    }

    public function editProfilUser(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'no_telp' => $request->no_telp !== $user->no_telp
                ? 'nullable|string|max:20|unique:users,no_telp'
                : 'nullable|string|max:20',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:2048',
        ], [
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
            'no_telp.unique' => 'Nomor telepon sudah terdaftar',
            'image.mimes' => 'Format gambar harus jpeg, jpg, atau png',
            'image.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        if ($request->no_telp !== $user->no_telp) {
            $user->no_telp = $request->input('no_telp');
        }

        $defaultImage = 'Dummy.png';

        if ($request->hasFile('image')) {
            if ($user->image !== $defaultImage && Storage::exists('public/users/' . $user->image)) {
                Storage::delete('public/users/' . $user->image);
            }

            $image = $request->file('image');
            $image->storeAs('public/users', $image->hashName());
            $user->image = $image->hashName();
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil Anda berhasil diubah.');
    }

    public function suspendUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->status = 'Offline';
            $user->last_online_at = now();
            $user->status_pelanggan = 'Suspended';
            $user->save();

            return redirect()->back()->with('success', 'Pengguna berhasil ditangguhkan.');
        }

        return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
    }

    public function banUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->status = 'Offline';
            $user->last_online_at = now();
            $user->status_pelanggan = 'Banned';
            $user->save();

            return redirect()->back()->with('success', 'Pengguna berhasil diblokir.');
        }

        return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
    }

    public function unsuspendUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        if (strcasecmp($user->status_pelanggan, 'Suspended') === 0) {
            $user->status_pelanggan = 'Aktif';
            $user->save();

            return redirect()->back()->with('success', 'Pengguna berhasil diaktifkan kembali.');
        }

        return redirect()->back()->with('error', 'Pengguna tidak dalam status suspended.');
    }
}
