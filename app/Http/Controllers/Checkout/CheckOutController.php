<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Models\CheckOut;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil semua checkout yang terkait dengan user
        $checkouts = CheckOut::whereHas('keranjang', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->orderBy('created_at', 'desc')->paginate(10);

        return view('user.checkout.index', compact('checkouts'));
    }

    public function create($keranjangId)
    {
        $keranjang = Keranjang::findOrFail($keranjangId);

        // Ambil item dari keranjang yang sudah dipilih
        $selectedItems = $keranjang->keranjangItems;

        if ($selectedItems->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Tidak ada item untuk diproses.');
        }

        // Menampilkan halaman checkout dengan data item keranjang
        return view('user.checkout', compact('keranjang', 'selectedItems'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Ambil keranjang berdasarkan user yang sedang login
        $keranjang = Keranjang::where('user_id', $user->id)->first();

        if (!$keranjang) {
            return redirect()->back()->with('error', 'Keranjang tidak ditemukan.');
        }

        // Ambil item dari keranjang
        $selectedItems = $keranjang->keranjangItems;

        // Buat data checkout
        $checkout = new \App\Models\CheckOut();
        $checkout->keranjang_id = $keranjang->id;
        $checkout->total_bayar = $selectedItems->sum('harga');
        $checkout->metode_pembayaran = $request->input('metode_pembayaran', 'Transfer'); // Bisa diganti sesuai form
        $checkout->save();

        // Setelah checkout selesai, kita bisa menghapus keranjang jika diinginkan
        $keranjang->delete();

        return redirect()->route('checkout.show', $checkout->id)->with('success', 'Checkout berhasil.');
    }
}
