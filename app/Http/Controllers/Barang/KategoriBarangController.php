<?php

namespace App\Http\Controllers\Barang;

use App\Http\Controllers\Controller;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    public function index()
    {
        // Ambil semua kategori barang, urutkan dari yang terbaru
        $kategoriBarangs = KategoriBarang::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.kategori-barang.index', compact('kategoriBarangs'));
    }

    public function create()
    {
        return view('admin.kategori-barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required',
        ]);

        // Simpan kategori barang ke database
        KategoriBarang::create([
            'nama' => $request->nama,
            'status' => $request->status,
        ]);

        return redirect()->route('kategori-barang.index')->with('success', 'Kategori barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategoriBarang = KategoriBarang::findOrFail($id);
        return view('admin.kategori-barang.edit', compact('kategoriBarang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required',
        ]);

        // Update kategori barang di database
        $kategoriBarang = KategoriBarang::findOrFail($id);
        $kategoriBarang->update([
            'nama' => $request->nama,
            'status' => $request->status,
        ]);

        return redirect()->route('kategori-barang.index')->with('success', 'Kategori barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Hapus kategori barang dari database
        $kategoriBarang = KategoriBarang::findOrFail($id);
        $kategoriBarang->delete();

        return redirect()->route('kategori-barang.index')->with('success', 'Kategori barang berhasil dihapus.');
    }

    public function destroySelected(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'exists:kategori_barangs,id',
        ]);

        KategoriBarang::whereIn('id', $request->ids)->delete();

        return redirect()->route('kategori-barang.index')->with('success', 'Kategori barang yang dipilih berhasil dihapus.');
    }
}
