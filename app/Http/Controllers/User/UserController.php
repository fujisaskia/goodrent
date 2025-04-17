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
        $user = auth()->user(); // Ambil user yang sedang login

        $users = User::whereHas('roles', function ($query) use ($user) {
            if ($user->hasRole('superadmin')) {
                // Superadmin melihat pelanggan & admin
                $query->whereIn('name', ['pelanggan', 'admin']);
            } else if ($user->hasRole('admin')) {
                // Admin hanya melihat pelanggan
                $query->where('name', 'pelanggan');
            }
        })->paginate(10); // Tambahkan pagination dengan 10 item per halaman

        return view('admin.kelola-user.index', compact('users'));
    }

    public function tambahAdminPage()
    {
        return view('admin.kelola-user.create');
    }

    public function tambahAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'no_telp' => 'required|unique:users,no_telp',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:2048',
        ], [
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
            'no_telp.unique' => 'Nomor telepon sudah terdaftar',
            'image.mimes' => 'Format gambar harus jpeg, jpg, atau png',
            'image.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->no_telp = $request->input('no_telp');

        $defaultImage = 'Dummy.png';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/users', $image->hashName());
            $user->image = $image->hashName();
        } else {
            $user->image = $defaultImage;
        }

        $user->status = 'Offline';
        $user->last_online_at = now();
        $user->status_pelanggan = 'Aktif';

        $user->save();

        // Menambahkan role pelanggan ke user yang baru dibuat
        $user->assignRole('admin');

        return redirect()->route('kelola-pelanggan')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function editProfilUser(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'nullable|string|max:50',
            'email' => 'nullable|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'no_telp' => $request->no_telp !== $user->no_telp
                ? 'nullable|string|max:20|unique:users,no_telp'
                : 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
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

        // Update gambar jika disediakan
        if ($request->hasFile('image')) {
            // Simpan dengan nama asli file
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('users', $imageName, 'public');

            // Simpan hanya nama file, bukan path lengkapnya
            $user->update(['image' => $imageName]);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil Anda berhasil diubah.');
    }

    // public function lihatPelanggan($id)
    // {
    //     $pelanggan = User::findOrFail($id); // Gunakan findOrFail untuk langsung memberikan error jika tidak ditemukan
    //     return view('admin.kelola-user.show', compact('pelanggan'));
    // }

    public function hapusPelanggan($id)
    {
        // Cek apakah user yang sedang login adalah superadmin
        if (!auth()->user()->hasRole('superadmin')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus pengguna.');
        }

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        // Cek apakah gambar user bukan default
        $defaultImage = 'Dummy.png'; // Nama file default yang digunakan
        if ($user->image && $user->image !== $defaultImage) {
            Storage::delete('public/users/' . $user->image); // Hapus dari storage
        }

        $user->delete(); // Hapus user dari database

        return redirect()->route('kelola-pelanggan')->with('success', 'Pengguna berhasil dihapus.');
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
