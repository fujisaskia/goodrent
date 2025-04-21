<!-- resources/views/home.blade.php -->
@extends('layouts/user')

@section('title', 'Pemesanan Saya')

@section('content')

    <div class="max-w-4xl mx-auto text-sm md:text-xs">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 my-4 text-center md:text-start">Riwayat Pemesanan</h2>
        @forelse ($pesanans as $pesanan)
            <div class=" bg-white shadow-lg rounded-sm p-4 mb-5">
                <div class="flex justify-between font-semibold pb-2 border-b border-gray-200">
                    <h5>{{ \Carbon\Carbon::parse($pesanan->created_at)->translatedFormat('d F, Y') }}</h5>
                    @php
                        $status = $pesanan->pembayaran?->status_pembayaran ?? 'Belum Dibayar';
                        $warna = match ($status) {
                            'Menunggu' => 'bg-yellow-600',
                            'Berhasil' => 'bg-green-600',
                            'Gagal' => 'bg-red-500',
                            default => 'bg-gray-400',
                        };

                        $statusPemesanan = $pesanan->status_pemesanan;
                        $warnaPemesanan = match ($statusPemesanan) {
                            'Menunggu' => 'bg-gray-500',
                            'Dalam Penyewaan' => 'bg-blue-600',
                            'Selesai' => 'bg-green-600',
                            'Dibatalkan' => 'bg-red-600',
                        };
                    @endphp

                    <div class="flex flex-col items-end space-y-3">
                        <p>Status Pembayaran |
                            <span class="text-xs {{ $warna }} py-1 px-3 text-white rounded-sm">
                                {{ $status }}
                            </span>
                        </p>
                        <p>Status Pemesanan |
                            <span class="text-xs {{ $warnaPemesanan }} py-1 px-3 text-white rounded-sm">
                                {{ $statusPemesanan }}
                            </span>
                        </p>
                    </div>

                </div>

                <div class="space-y-2 mt-4">
                    @foreach ($pesanan->items as $item)
                        @php
                            $barang = $item->barang;
                        @endphp
                        <div class="flex items-center p-1 border-b">
                            <img src="{{ asset('storage/barangs/' . $barang?->image) }}" alt="{{ $barang?->nama_barang }}"
                                class="w-16 h-16 rounded-lg object-cover">
                            <div class="ml-4 flex-1">
                                <div class="mb-2 md:mb-0">
                                    <h3 class="text-sm font-semibold text-gray-900">{{ $barang?->nama_barang }}</h3>
                                    <p class="text-xs text-gray-500">
                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F, Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F, Y') }}
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
                                    <p class="text-sm font-bold">Rp{{ number_format($item->harga_barang, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="my-2 px-2 flex justify-between font-semibold text-sm text-blue-500">
                    <p>Potongan Harga</p>
                    <h4>- Rp{{ number_format($pesanan->potongan_harga, 0, ',', '.') }}</h4>
                </div>

                <div class="my-2 p-2 flex justify-between items-center text-base font-semibold">
                    <p class="text-gray-700">TOTAL</p>
                    <p class="text-red-600 text-lg font-bold">Rp{{ number_format($pesanan->total_bayar, 0, ',', '.') }}</p>
                </div>

                @php
                    $statusPemesanan = $pesanan->status_pemesanan;

                    $disableButton =
                        in_array($statusPemesanan, ['Selesai', 'Dibatalkan'])
                @endphp

                <form id="form-batalkan-{{ $pesanan->id }}" action="{{ route('user.riwayat.batalkan', $pesanan->id) }}"
                    method="POST">
                    @csrf
                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="konfirmasiPembatalan({{ $pesanan->id }})"
                            class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md shadow-md disabled:opacity-50 disabled:cursor-not-allowed"
                            @if ($disableButton) disabled @endif>
                            Batalkan Penyewaan
                        </button>
                    </div>
                </form>

            </div>
        @empty
            <p>Tidak ada Pemesanan yang anda lakukan ^^</p>
        @endforelse
    </div>

    <script>
        function konfirmasiPembatalan(id) {
            Swal.fire({
                title: 'Yakin ingin membatalkan?',
                text: "Penyewaan ini akan dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-batalkan-' + id).submit();
                }
            });
        }
    </script>

@endsection
