<?php

namespace App\Http\Controllers\Keranjang;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\KeranjangItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangItemController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil keranjang milik user yang sedang login
        $keranjang = Keranjang::where('user_id', $user->id)->first();

        // Jika tidak ada keranjang, kembalikan dengan pesan
        if (!$keranjang) {
            return redirect()->back()->with('error', 'Keranjang tidak ditemukan.');
        }

        // Ambil item keranjang dan relasi pesanan
        $keranjangItems = KeranjangItem::with('pesanan')
            ->where('keranjang_id', $keranjang->id)
            ->get();

        return view('user.keranjang', compact('keranjangItems', 'keranjang'));
    }
}
