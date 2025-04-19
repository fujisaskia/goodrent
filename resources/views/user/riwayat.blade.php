<!-- resources/views/home.blade.php -->
@extends('layouts/user')

@section('title', 'Pemesanan Saya')

@section('content')

    <div class="max-w-4xl mx-auto text-sm md:text-xs">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 my-4 text-center md:text-start">Riwayat Pemesanan</h2>
        @forelse ($pesanans as $pesanan)
            @php
                $item = $pesanan->items->first();
                $barang = $item?->barang;
                $hargaSewa = $item?->harga_barang;
            @endphp
            <div class=" bg-white shadow-lg rounded-sm p-4 mb-5">
                <div class="flex justify-between font-semibold pb-2 border-b border-gray-200">
                    <h5>{{ \Carbon\Carbon::parse($pesanan->created_at)->translatedFormat('d F, Y') }}</h5>
                    <p class="">Status | <span
                            class="text-xs bg-blue-400 py-1 px-3 text-white rounded-sm">{{ $pesanan->status_pemesanan }}</span>
                    </p>
                </div>

                <div class="space-y-2 mt-4">
                    <!-- Item 1 -->
                    <div class="flex items-center p-1 border-b">
                        <img src="{{ asset('storage/barangs/' . $barang?->image) }}" alt="{{ $barang?->nama_barang }}"
                            class="w-16 h-16 rounded-lg object-cover" class="w-16 h-16 rounded-lg object-cover">
                        <div class="ml-4 flex-1">
                            <div class="mb-2 md:mb-0">
                                <h3 class="text-sm font-semibold text-gray-900">{{ $barang?->nama_barang }}</h3>
                                <p class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($pesanan->items->first()?->tanggal_mulai)->translatedFormat('d F, Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($pesanan->items->first()?->tanggal_selesai)->translatedFormat('d F, Y') }}
                                </p>
                            </div>
                            <div class="flex justify-between text-right mb-2">
                                <p class="font-semibold mt-1">Durasi:
                                    @if ($item->durasi_sewa >= 24)
                                        {{ floor($item->durasi_sewa / 24) }} Hari
                                    @else
                                        {{ $item->durasi_sewa }} Jam
                                    @endif
                                </p>
                                <p class="text-sm font-bold">Rp{{ number_format($item->harga_barang, 0, ',', '.') }}</p>
                            </div>
                            {{-- <div class="flex justify-end">
                        <a href="" class="bg-emerald-600 py-2 px-4 text-white">
                            Sewa Lagi
                        </a>
                    </div> --}}
                        </div>
                    </div>
                </div>

                <!-- Total Section -->
                <div class="mt-4 p-2 mb-2 flex justify-between items-center text-base font-semibold rounded-b-lg">
                    <p class="text-gray-700">TOTAL</p>
                    <p class="text-red-600 text-lg font-bold">Rp{{ number_format($pesanan->total_bayar, 0, ',', '.') }}</p>
                </div>

                <div class="flex justify-end space-x-3 font-semibold items-center">
                    <a href="" class="bg-yellow-400 hover:bg-yellow-500 text-center py-2 px-4 w-32">
                        Nilai
                    </a>
                    <a href=""
                        class="border-2 border-gray-800 hover:bg-black hover:text-white text-center py-2 px-4 duration-300 w-32">
                        Lihat
                    </a>
                </div>

            </div>

        @empty
        <p>Tidak ada Pemesanan yang anda lakukan ^^</p>
        @endforelse

    </div>

@endsection
