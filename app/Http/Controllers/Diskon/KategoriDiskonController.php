<?php

namespace App\Http\Controllers\Diskon;

use App\Http\Controllers\Controller;
use App\Models\KategoriDiskon;
use Illuminate\Http\Request;

class KategoriDiskonController extends Controller
{
    public function index()
    {
        // Ambil semua kategori diskon dari database
        $kategoriDiskons = KategoriDiskon::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.kategori-diskon.index', compact('kategoriDiskons'));
    }

    public function create()
    {
        return view('admin.kategori-diskon.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required',
        ]);

        // Simpan kategori diskon ke database
        KategoriDiskon::create([
            'nama' => $request->nama,
            'status' => $request->status,
        ]);

        return redirect()->route('kategori-diskon.index')->with('success', 'Kategori diskon berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategoriDiskon = KategoriDiskon::findOrFail($id);
        return view('admin.kategori-diskon.edit', compact('kategoriDiskon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required',
        ]);

        // Update kategori diskon di database
        $kategoriDiskon = KategoriDiskon::findOrFail($id);
        $kategoriDiskon->update([
            'nama' => $request->nama,
            'status' => $request->status,
        ]);

        return redirect()->route('kategori-diskon.index')->with('success', 'Kategori diskon berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategoriDiskon = KategoriDiskon::findOrFail($id);
        $kategoriDiskon->delete();

        return redirect()->route('kategori-diskon.index')->with('success', 'Kategori diskon berhasil dihapus.');
    }

    public function destroySelected(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'exists:kategori_diskons,id',
        ]);

        KategoriDiskon::whereIn('id', $request->ids)->delete();

        return redirect()->route('kategori-diskon.index')->with('success', 'Kategori diskon yang dipilih berhasil dihapus.');
    }
}
