@extends('layouts/admin')

@section('title', 'Data Sewa')

@section('content')

    <div class="mx-auto p-2">
        <h2 class="flex space-x-3 text-2xl md:text-3xl font-bold mb-4 items-center justify-center md:justify-start">
            <i class="fa-solid fa-bag-shopping text-4xl text-emerald-800"></i>
            <span>Data Sewa</span>
        </h2>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <form method="GET" action="{{ route('admin.data-sewa.index') }}">
                <div class="flex space-x-4 mb-3">
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari Pelanggan"
                        class="border p-3 rounded-lg w-60 focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                        <button type="submit"
                        class="py-3 px-4 bg-emerald-600 rounded-full text-white focus:scale-95 duration-300">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>

            <div class="overflow-x-auto lg:overflow-visible">
                <table class="w-full border-collapse border rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-500 text-white uppercase">
                            <th class="p-3">no</th>
                            <th class="p-3">Nama Pelanggan</th>
                            <th class="p-3">Tanggal Sewa</th>
                            <th class="p-3">durasi sewa</th>
                            <th class="p-3">Metode Bayar</th>
                            <th class="p-3">Status Bayar</th>
                            <th class="p-3">Status Pesanan</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @forelse ($pesanans as $index => $pesanan)
                            <tr class="border-b text-center hover:bg-gray-50">
                                <td class="p-3">{{ $index + 1 }}</td>
                                <td class="p-3 capitalize">{{ $pesanan->user->name }}</td>
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($pesanan->items->first()?->tanggal_mulai)->translatedFormat('d F, Y') }}
                                    -
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

                                {{-- <td class="p-3">{{ $pesanan->items->first()?->barang->jenis_ps ?? '-' }}</td> --}}
                                {{-- <td class="p-3">{{ $pesanan->items->first()?->barang->nomor_ps ?? '-' }}</td> --}}
                                <td class="p-3">
                                    @php
                                        $metodePembayaran = $pesanan->pembayaran->metode_pembayaran ?? null;

                                        $metodeColor = match ($metodePembayaran) {
                                            'Digital' => 'bg-yellow-500',
                                            'Tunai' => 'bg-blue-500',
                                        };

                                        $labelMetode = $metodePembayaran ?? '-';
                                    @endphp

                                    <span class="py-1 px-3 {{ $metodeColor }} text-white rounded-full">
                                        {{ $labelMetode }}
                                    </span>
                                </td>
                                <td class="p-3">
                                    @php
                                        $statusPembayaran = $pesanan->pembayaran->status_pembayaran ?? '-';
                                        $statusColor = '';

                                        if ($statusPembayaran == 'Berhasil') {
                                            $statusColor = 'bg-green-600';
                                        } elseif ($statusPembayaran == 'Menunggu') {
                                            $statusColor = 'bg-orange-500';
                                        } elseif ($statusPembayaran == 'Gagal') {
                                            $statusColor = 'bg-red-500';
                                        } else {
                                            $statusColor = 'bg-gray-500'; // Default untuk status yang tidak teridentifikasi
                                        }
                                    @endphp

                                    <span
                                        class="py-1 px-3 {{ $statusColor }} text-white rounded-full">{{ $statusPembayaran }}</span>
                                </td>
                                <td class="p-3">
                                    @php
                                        $statusPemesanan = $pesanan->status_pemesanan ?? '-';
                                        $statusColor = '';

                                        if ($statusPemesanan == 'Menunggu') {
                                            $statusColor = 'bg-gray-500';
                                        } elseif ($statusPemesanan == 'Dalam Penyewaan') {
                                            $statusColor = 'bg-orange-500';
                                        } elseif ($statusPemesanan == 'Selesai') {
                                            $statusColor = 'bg-green-500';
                                        } else {
                                            $statusColor = 'bg-red-500'; // Default untuk status yang tidak teridentifikasi
                                        }
                                    @endphp

                                    <span
                                        class="py-1 px-3 {{ $statusColor }} text-white rounded-full">{{ $statusPemesanan }}</span>
                                </td>
                                <td class="p-3 flex items-center justify-center gap-6">
                                    <button onclick="showDetail({{ $pesanan->id }})"
                                        class="bg-blue-400 hover:bg-blue-500  shadow-md shadow-blue-300 hover:shadow-none focus:scale-95 duration-300
                                            text-white py-2 px-2.5 rounded-full"
                                        title="Lihat">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                    {{-- Jika status pemesanan belum selesai --}}
                                    @if ($pesanan->status_pemesanan !== 'Selesai')
                                        {{-- Jika metode pembayaran adalah Tunai --}}
                                        @if ($pesanan->pembayaran->metode_pembayaran === 'Tunai')
                                            {{-- Jika status pembayaran belum berhasil --}}
                                            @if ($pesanan->pembayaran->status_pembayaran !== 'Berhasil')
                                                {{-- Tombol untuk mengonfirmasi pembayaran Tunai --}}
                                                <form id="form-tunai-{{ $pesanan->pembayaran->id }}"
                                                    action="{{ route('pembayaran.updateStatusTunai', $pesanan->pembayaran->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="button"
                                                        onclick="confirmPembayaranTunai('{{ $pesanan->pembayaran->id }}')"
                                                        class="bg-green-600 hover:bg-green-500 shadow-md shadow-green-600 hover:shadow-none focus:scale-95 duration-300
        text-white py-2 px-2.5 rounded-full"
                                                        title="Konfirmasi Pembayaran Tunai">
                                                        <i class="fa-solid fa-dollar-sign w-3 h-3"></i>
                                                    </button>
                                                </form>
                                            @else
                                                {{-- Jika pembayaran tunai berhasil, tampilkan tombol selesaikan sewa --}}
                                                <form action="{{ route('pesanan.updateStatusSelesai', $pesanan->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="bg-green-600 hover:bg-green-500 shadow-md shadow-green-600 hover:shadow-none focus:scale-95 duration-300
                text-white py-2 px-2.5 rounded-full"
                                                        title="Selesaikan Sewa (Tunai)">
                                                        <i class="fa-solid fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @endif

                                        {{-- Jika metode pembayaran adalah Digital --}}
                                        @if ($pesanan->pembayaran->metode_pembayaran === 'Digital')
                                            {{-- Tombol untuk menyelesaikan sewa Digital --}}
                                            <form action="{{ route('pesanan.updateStatusDigital', $pesanan->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="bg-green-600 hover:bg-green-500 shadow-md shadow-green-600 hover:shadow-none focus:scale-95 duration-300
            text-white py-2 px-2.5 rounded-full"
                                                    title="Selesaikan Sewa (Digital)">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        {{-- Jika status pemesanan sudah selesai, tombol disable --}}
                                        <button disabled
                                            class="bg-gray-400 text-white py-2 px-2.5 rounded-full cursor-not-allowed"
                                            title="Pemesanan telah selesai">
                                            <i class="fa-solid fa-check-double"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-6 text-gray-500">Belum ada data diskon.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    @include('admin.data-sewa.show')

    <script>
        function confirmPembayaranTunai(pesananId) {
            Swal.fire({
                title: 'Konfirmasi Pembayaran?',
                text: "Apakah Anda yakin ingin mengonfirmasi pembayaran tunai ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Konfirmasi!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-tunai-' + pesananId).submit();
                }
            })
        }
    </script>

@endsection
