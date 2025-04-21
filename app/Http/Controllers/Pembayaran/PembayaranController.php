<?php

namespace App\Http\Controllers\Pembayaran;

use App\Http\Controllers\Controller;
use App\Models\CheckOut;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use Illuminate\Support\Carbon; // pastikan ini ada di atas


class PembayaranController extends Controller
{
    //     public function __construct()
    //     {
    //         // Konfigurasi Midtrans
    //         \Midtrans\Config::$serverKey = config('midtrans.server_key');
    //         \Midtrans\Config::$clientKey = config('midtrans.client_key');
    //         \Midtrans\Config::$isProduction = config('midtrans.is_production');
    //         \Midtrans\Config::$isSanitized = true;
    //         \Midtrans\Config::$is3ds = true;
    //     }


    public function process($pesanan_id)
    {
        \Log::info('Proses pembayaran untuk pesanan ID: ' . $pesanan_id);
        $pesanan = Pesanan::findOrFail($pesanan_id);

        // Midtrans Config
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $totalBayar = $pesanan->total_bayar;
        $nomorPembayaran = 'NUM' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT) . date('Y');

        // Simpan ke DB
        $pembayaran = Pembayaran::create([
            'pesanan_id' => $pesanan->id,
            'total_bayar' => $totalBayar,
            'nomor_pembayaran' => $nomorPembayaran,
            'tanggal_bayar' => Carbon::now(),
            'metode_pembayaran' => 'Digital',
            'status_pembayaran' => 'Menunggu',
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $nomorPembayaran,
                'gross_amount' => $totalBayar,
            ],
            'customer_details' => [
                'first_name' => $pesanan->user->name,
                'email' => $pesanan->user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['snapToken' => $snapToken]);
    }

    public function paymentSuccess(Request $request)
    {
        $pembayaran = Pembayaran::where('nomor_pembayaran', $request->order_id)->firstOrFail();

        $pembayaran->update([
            'status_pembayaran' => 'Berhasil',
            'tanggal_bayar' => now(),
        ]);

        // Update status pemesanan dan kurangi stok barang
        if ($pembayaran->pesanan) {
            $pesanan = $pembayaran->pesanan;

            $pesanan->update([
                'status_pemesanan' => 'Dalam Penyewaan',
            ]);

            foreach ($pesanan->items as $item) {
                if ($item->barang) {
                    $barang = $item->barang;
                    $barang->stok -= 1;
                    $barang->save();
                }
            }
        }

        return response()->json(['redirect' => route('user.riwayat.index')]);
    }

    public function paymentFailed(Request $request)
    {
        $pembayaran = Pembayaran::where('nomor_pembayaran', $request->order_id)->firstOrFail();

        $pembayaran->update([
            'status_pembayaran' => 'Gagal',
            'tanggal_bayar' => now(),
        ]);

        // Update status pemesanan dan kurangi stok barang
        if ($pembayaran->pesanan) {
            $pesanan = $pembayaran->pesanan;

            $pesanan->update([
                'status_pemesanan' => 'Menunggu',
            ]);
        }

        return response()->json(['redirect' => route('checkout.summary')]);
    }

    public function processCash($pesanan_id)
    {
        \Log::info('Proses pembayaran tunai untuk pesanan ID: ' . $pesanan_id);

        $pesanan = Pesanan::findOrFail($pesanan_id);  // Menangani pencarian pesanan berdasarkan ID

        $totalBayar = $pesanan->total_bayar;
        $nomorPembayaran = 'NUM' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT) . date('Y');

        // Simpan pembayaran tunai
        Pembayaran::create([
            'pesanan_id' => $pesanan->id,
            'total_bayar' => $totalBayar,
            'nomor_pembayaran' => $nomorPembayaran,
            'tanggal_bayar' => now(),
            'metode_pembayaran' => 'Tunai',
            'status_pembayaran' => 'Menunggu',
        ]);

        // Mengembalikan response JSON
        return response()->json([
            'message' => 'Pembayaran tunai berhasil diproses',
            'redirect' => route('user.riwayat.index'), // Pastikan route sudah benar
        ]);
    }



    //     // Menampilkan halaman pembayaran
    //     public function showPaymentForm($checkoutId)
    //     {
    //         $checkout = CheckOut::findOrFail($checkoutId);
    //         return view('user.payment.index', compact('checkout'));
    //     }

    //     // Proses pembayaran
    //     public function processPayment(Request $request, $checkoutId)
    //     {
    //         $checkout = CheckOut::findOrFail($checkoutId);

    //         // Menyimpan pembayaran
    //         $payment = new Pembayaran();
    //         $payment->check_out_id = $checkout->id;
    //         $payment->metode_pembayaran = $request->input('metode_pembayaran');
    //         $payment->jumlah_bayar = $checkout->total_bayar;
    //         $payment->status_pembayaran = 'Menunggu'; // Status awal
    //         $payment->save();

    //         // Jika metode pembayaran adalah Digital (menggunakan Midtrans)
    //         if ($payment->metode_pembayaran == 'Digital') {
    //             $snapToken = $this->generateMidtransToken($checkout);

    //             // Update status pembayaran menjadi 'Menunggu' dan simpan token Midtrans
    //             $payment->snap_token = $snapToken;
    //             $payment->save();

    //             // Redirect ke Midtrans Snap page
    //             return redirect()->to($this->getMidtransRedirectUrl($snapToken));
    //         }

    //         return redirect()->route('user.payment.index', ['checkoutId' => $checkoutId])->with('success', 'Pembayaran berhasil diproses.');
    //     }

    //     // Fungsi untuk generate Snap Token Midtrans
    //     private function generateMidtransToken(CheckOut $checkout)
    //     {
    //         $transactionDetails = [
    //             'order_id' => 'ORDER-' . $checkout->id,
    //             'gross_amount' => $checkout->total_bayar,
    //         ];

    //         $itemDetails = [
    //             [
    //                 'id' => 'item1',
    //                 'price' => $checkout->total_bayar,
    //                 'quantity' => 1,
    //                 'name' => 'Pembayaran Order #' . $checkout->id,
    //             ]
    //         ];

    //         $customerDetails = [
    //             'first_name' => auth()->user()->name,
    //             'email' => auth()->user()->email,
    //         ];

    //         // Prepare the Midtrans transaction
    //         $transactionData = [
    //             'transaction_details' => $transactionDetails,
    //             'item_details' => $itemDetails,
    //             'customer_details' => $customerDetails,
    //         ];

    //         try {
    //             $snap = new Snap();
    //             $response = $snap->createTransaction($transactionData);
    //             return $response->token;
    //         } catch (\Exception $e) {
    //             // Jika terjadi error saat mendapatkan Snap token
    //             return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pembayaran.');
    //         }
    //     }

    //     // Mendapatkan URL untuk redirect ke Midtrans Snap
    //     private function getMidtransRedirectUrl($snapToken)
    //     {
    //         return 'https://app.midtrans.com/snap/v2/v2-pages/credit-card?token=' . $snapToken;
    //     }
}
