<?php

namespace App\Http\Controllers\DataSewa;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataSewaController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $pesanans = Pesanan::with(['items', 'barang', 'pembayaran', 'user'])
        ->whereHas('pembayaran', function ($query) {
            $query->where('status_pembayaran', 'Berhasil');
        })
        ->when($search, function ($query, $search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        })
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.data-sewa.index', compact('pesanans'));
}

}
