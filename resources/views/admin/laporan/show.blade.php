@extends('layouts/admin')

@section('title', 'Laporan GoodRent')

@section('content')

    <div class="p-6 max-w-xl mx-auto bg-white rounded-xl shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Lihat Pesanan</h2>
            <span class="px-4 py-1 bg-green-500 text-white rounded-full text-sm">Selesai</span>
        </div>

        <div class="border-t pt-4">
            <div class="flex justify-between mb-2">
                <div>
                    <p class="text-gray-600">Nama Pelanggan</p>
                    <p class="font-semibold capitalize text-sm">{{ $pesanan->user->name }}</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-600">No HP</p>
                    <p class="font-semibold text-sm">{{ $pesanan->user->no_telp }}</p>
                </div>
            </div>

            <div class="mt-4 space-y-4">
                @foreach ($pesanan->items as $item)
                    <div class="flex items-start gap-3 border-b pb-2">
                        <img src="{{ asset('storage/barangs/' . $item->barang->image) }}"
                            alt="{{ $item->barang->nama_barang }}" class="w-14 h-14 rounded-md object-cover">
                        <div class="flex-1">
                            <h3 class="font-semibold">{{ $item->barang->nama_barang }}</h3>
                            <p class="text-xs text-gray-500">
                                {{ $item->tanggal_mulai }} - {{ $item->tanggal_selesai }} <br>
                                Durasi:
                                @if ($item->durasi_sewa >= 24)
                                    {{ floor($item->durasi_sewa / 24) }} Hari
                                @else
                                    {{ $item->durasi_sewa }} Jam
                                @endif
                            </p>
                        </div>
                        <div class="text-right font-semibold">
                            Rp{{ number_format($item->harga_barang, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between mt-2 font-bold text-sm text-right text-blue-600">
                <p class="">Potongan Harga</p>
                <span class="">
                    - Rp{{ number_format($pesanan->potongan_harga ?? 0, 0, ',', '.') }}
                </span>
            </div>

            <div class="flex justify-between mt-2 font-bold text-xl text-right text-red-600">
                <p>TOTAL</p>
                <span>Rp{{ number_format($pesanan->total_bayar, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between mt-6 border-t pt-4">
                <p class="text-sm text-gray-500 mb-1">Status Pembayaran</p>
                <span class="px-4 py-1 bg-green-500 text-white rounded-full text-sm">
                    {{ $pesanan->pembayaran->status_pembayaran ?? '---' }}
                </span>
            </div>
        </div>
    </div>


@endsection
