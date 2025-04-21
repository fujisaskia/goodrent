@extends('layouts/admin')

@section('title', 'Laporan GoodRent')

@section('content')

    <div class="mx-auto p-2">
        <h2 class="flex space-x-3 text-2xl md:text-3xl font-bold mb-4 items-center justify-center md:justify-start">
            <i class="fa-solid fa-folder-open text-emerald-800"></i>
            <span>Laporan GoodRent</span>
        </h2>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('laporan.index') }}" method="GET">
                <div class="flex flex-col md:flex-row justify-between mb-4">
                    <div class="flex space-x-0 md:space-x-4 mb-4 md:mb-0 items-center font-semibold">
                        <p class="hidden md:flex">Cari :</p>
                        <input type="search" name="search" placeholder="Cari Pelanggan"
                            class="border p-3 rounded-lg w-full md:w-60 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            value="{{ request()->search }}" />
                    </div>
                    <div class="flex flex-col md:flex-row justify-between space-x-4">
                        <div class="flex mb-4 md:mb-0">
                            <!-- Masa Awal -->
                            <input type="text" id="awal-laporan" name="awal_laporan"
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                                placeholder="Pilih tanggal awal" required value="{{ request()->awal_laporan }}">
                            <span class="p-2 text-xs font-bold text-center">s/d</span>
                            <!-- Masa Akhir -->
                            <input type="text" id="akhir-laporan" name="akhir_laporan"
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                                placeholder="Pilih tanggal akhir" required value="{{ request()->akhir_laporan }}">
                        </div>
                        <button type="submit"
                            class="py-3 px-4 shadow-2xl hover:shadow-none bg-emerald-600 rounded-full text-white focus:scale-95 duration-300">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </form>

            <a href="{{ route('laporan.cetak', request()->all()) }}" class="flex w-1/2 md:w-32 ml-auto justify-end mb-4">
                <button type="submit"
                    class="w-full px-5 py-3 md:p-3 text-center bg-yellow-500 hover:bg-yellow-600 rounded-xl text-white focus:scale-95 duration-300">
                    Cetak Laporan
                </button>
            </a>


            <div class="overflow-x-auto lg:overflow-visible">
                <table class="w-full border-collapse border rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-500 text-white uppercase">
                            <th class="p-3">No</th>
                            <th class="p-3">Nama Pelanggan</th>
                            <th class="p-3">Barang disewa</th>
                            <th class="p-3">Tanggal Sewa</th>
                            <th class="p-3">Durasi Sewa</th>
                            <th class="p-3">Metode Bayar</th>
                            <th class="p-3">Status Bayar</th>
                            <th class="p-3">Status Pesanan</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesanans as $index => $pesanan)
                            <tr class="border-b text-center hover:bg-gray-50">
                                <td class="p-3">{{ $index + 1 }}</td>
                                <td class="p-3 capitalize">{{ $pesanan->user->name }}</td>
                                <td class="p-3">{{ implode(', ', $pesanan->items->pluck('barang.nama_barang')->toArray()) }}</td>
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($pesanan->items->first()?->tanggal_mulai)->translatedFormat('d F, Y') }} -
                                    {{ \Carbon\Carbon::parse($pesanan->items->first()?->tanggal_selesai)->translatedFormat('d F, Y') }}
                                </td>
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
                                <td class="p-3">{{ $pesanan->pembayaran->metode_pembayaran ?? '-' }}</td>
                                <td class="p-3 md:text-[10px]">
                                    @php
                                        $statusPembayaran = $pesanan->pembayaran->status_pembayaran ?? '-';
                                        $statusColor = '';
                                        
                                        if ($statusPembayaran == 'Berhasil') {
                                            $statusColor = 'bg-green-600';
                                        } else {
                                            $statusColor = 'bg-gray-500'; // Default untuk status yang tidak teridentifikasi
                                        }
                                    @endphp
                                    
                                    <span class="py-1 px-3 {{ $statusColor }} text-white rounded-full">{{ $statusPembayaran }}</span>  
                                </td>
                                <td class="p-3 md:text-[10px]">
                                    @php
                                        $statusPemesanan = $pesanan->status_pemesanan ?? '-';
                                        $statusColor = '';
                                        
                                        if ($statusPemesanan == 'Selesai') {
                                            $statusColor = 'bg-green-500';
                                        } else {
                                            $statusColor = 'bg-red-500'; // Default untuk status yang tidak teridentifikasi
                                        }
                                    @endphp
                                    
                                    <span class="py-1 px-3 {{ $statusColor }} text-white rounded-full">{{ $statusPemesanan }}</span> 
                                </td>
                                <td class="p-3 flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.laporan.lihat', $pesanan->id) }}">
                                        @include('components.crud.read')
                                    </a>                                    
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-8 text-gray-500">Tidak ada data pesanan selesai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        flatpickr("#awal-laporan", {
            dateFormat: "d F Y",
            locale: "id", // Set lokal ke Bahasa Indonesia
            onChange: function(selectedDates, dateStr) {
                masaAkhir.set("minDate", dateStr); // Mencegah tanggal akhir sebelum tanggal awal
            }
        });

        let masaAkhir = flatpickr("#akhir-laporan", {
            dateFormat: "d F Y",
            locale: "id", // Set lokal ke Bahasa Indonesia
        });
    </script>
@endsection
