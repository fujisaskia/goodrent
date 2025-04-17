<?php

namespace App\Http\Controllers\Keranjang;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $keranjang = Keranjang::where('user_id', $user->id)->first();

        return view('user.keranjang', compact('keranjang'));
    }

    public function moveToCheckout(Request $request)
    {
        $user = Auth::user();

        // Ambil keranjang berdasarkan user yang sedang login
        $keranjang = Keranjang::where('user_id', $user->id)->first();

        if (!$keranjang) {
            return redirect()->back()->with('error', 'Keranjang tidak ditemukan.');
        }

        // Ambil item yang ada di keranjang
        $selectedItems = $keranjang->keranjangItems;

        if ($selectedItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        // Redirect ke halaman checkout untuk menyelesaikan proses
        return redirect()->route('checkout.create', ['keranjang_id' => $keranjang->id]);
    }
}
