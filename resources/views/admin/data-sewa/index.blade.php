@extends('layouts/admin')

@section('title', 'Data Sewa')

@section('content')

    <div class="mx-auto p-2">
        <h2 class="flex space-x-3 text-2xl md:text-3xl font-bold mb-4 items-center justify-center md:justify-start">
            <i class="fa-solid fa-bag-shopping text-4xl text-emerald-800"></i>
            <span>Data Sewa</span>
        </h2>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row justify-between mb-4">
                <div class="flex space-x-4 mb-2 md:mb-0">
                    <input type="search" placeholder="Cari Pelanggan"
                        class="border p-3 rounded-lg w-60 focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                    <button class="py-3 px-4 bg-emerald-600 rounded-full text-white focus:scale-95 duration-300">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto lg:overflow-visible">
                <table class="w-full border-collapse border rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-500 text-white uppercase">
                            <th class="p-3">no</th>
                            <th class="p-3">Nama Pelanggan</th>
                            <th class="p-3">Tanggal Sewa</th>
                            <th class="p-3">durasi sewa</th>
                            <th class="p-3">Metode Bayar</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($pesanans as $index => $pesanan)
                            <tr class="border-b text-center hover:bg-gray-50">
                                <td class="p-3">{{ $index + 1 }}</td>
                                <td class="p-3 capitalize">{{ $pesanan->user->name }}</td>
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($pesanan->items->first()?->tanggal_mulai)->translatedFormat('d F, Y') }} -
                                    {{ \Carbon\Carbon::parse($pesanan->items->first()?->tanggal_selesai)->translatedFormat('d F, Y') }}</td>
                                @php
                                    $durasi = $pesanan->items->first()?->durasi_sewa;
                                @endphp

                                <td class="p-3">
                                    @if ($durasi >= 24)
                                        {{ floor($durasi / 24) }} Hari
                                    @else
                                        {{ $durasi }} Jam
                                    @endif
                                </td>


                                {{-- <td class="p-3">{{ $pesanan->items->first()?->barang->jenis_ps ?? '-' }}</td> --}}
                                {{-- <td class="p-3">{{ $pesanan->items->first()?->barang->nomor_ps ?? '-' }}</td> --}}
                                <td class="p-3">{{ $pesanan->pembayaran->metode_pembayaran ?? '-' }}</td>
                                <td class="p-3 flex items-center justify-center gap-2">
                                    <a href="">
                                        @include('components.crud.read')
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


@endsection
