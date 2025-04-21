<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan Sewa</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-size: 12px;
        }

        .container {
            max-width: 900px;
            /* margin: 2rem auto; */
            background-color: white;
            /* padding: 2rem; */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .time {
            color: #16a34a;
            font-size: 12px
        }

        .header img {
            width: 160px;
            height: 160px;
            object-fit: contain;
            margin-bottom: 1rem;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            font-size: 11px;
        }

        thead {
            background-color: #6b7280;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
        }

        th,
        td {
            padding: 0.75rem;
            border: 1px solid #ddd;
            text-align: center;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 9999px;
            color: white;
            display: inline-block;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="{{ public_path('assets/logo-fixed.png') }}" alt="Logo" style="width: 80px; height: 80px;">
            <h1>Laporan Penyewaan</h1>
            <h5 class="time">Waktu: 
                <span class="">
                    {{ $awalLaporan ? $awalLaporan->format('d F Y') : 'semua data' }}
                </span> - 
                <span class="">
                    {{ $akhirLaporan ? $akhirLaporan->format('d F Y') : '!' }}
                </span>
            </h5>
            
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Barang Disewa</th>
                    <th>Tanggal Sewa</th>
                    <th>Durasi Sewa</th>
                    <th>Metode Bayar</th>
                    <th>Status Bayar</th>
                    <th>Status Pesanan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pesanans as $index => $pesanan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pesanan->user->name }}</td>
                        <td>{{ implode(', ', $pesanan->items->pluck('barang.nama_barang')->toArray()) }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($pesanan->items->first()?->tanggal_mulai)->translatedFormat('d F, Y') }} -
                            {{ \Carbon\Carbon::parse($pesanan->items->first()?->tanggal_selesai)->translatedFormat('d F, Y') }}
                        </td>
                        @php
                            $durasi = $pesanan->items->first()?->durasi_sewa;
                        @endphp
                        <td>
                            @if ($durasi >= 24)
                                {{ floor($durasi / 24) }} Hari
                            @else
                                {{ $durasi }} Jam
                            @endif
                        </td>
                        <td>{{ $pesanan->pembayaran->metode_pembayaran ?? 'tidak diketahui' }}</td>
                        <td>
                            @php
                                $statusPembayaran = $pesanan->pembayaran->status_pembayaran ?? '---';
                                $warnaPembayaran = match($statusPembayaran) {
                                    'Berhasil' => '#16a34a', // green
                                    'Pending' => '#facc15',  // yellow
                                    'Gagal' => '#dc2626',    // red
                                    default => '#6b7280'     // gray
                                };
                            @endphp
                            <span class="badge" style="background-color: {{ $warnaPembayaran }};">
                                {{ $statusPembayaran }}
                            </span>
                        </td>
                        <td>
                            @php
                                $statusPemesanan = $pesanan->status_pemesanan ?? '-';
                                $warnaPemesanan = match($statusPemesanan) {
                                    'Selesai' => '#22c55e', // green
                                    'Dibatalkan' => '#ef4444', // red
                                    'Diproses' => '#3b82f6', // blue
                                    default => '#6b7280' // gray
                                };
                            @endphp
                            <span class="badge" style="background-color: {{ $warnaPemesanan }};">
                                {{ $statusPemesanan }}
                            </span>
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

</body>

</html>



{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Sewa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="container mx-auto text-sm">
        <div class="flex flex-col space-y-3 mb-6 justify-center items-center mx-auto">
            <img src="{{ asset('assets/logo-fixed.png') }}" alt="" class="w-40 h-40">
            <h1 class="text-3xl font-bold mb-4">Laporan Penyewaan</h1>
            <h5 class="font-semibold">Waktu: 
                <span class="text-blue-500">{{ $awalLaporan->format('d F Y') ?? 'semua data'}}</span> - 
                <span class="text-blue-500">{{ $akhirLaporan->format('d F Y') ?? 'semua data'}}</span>
            </h5>
        </div>

        <table class="min-w-full table-auto border border-gray-300 bg-white shadow-md rounded">
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
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanans as $index => $pesanan)
                    <tr class="border-b text-center">
                        <td class="p-3">{{ $index + 1 }}</td>
                        <td class="p-3">{{ $pesanan->user->name }}</td>
                        <td class="p-3">{{ implode(', ', $pesanan->items->pluck('barang.nama_barang')->toArray()) }}</td>
                        <td class="p-3">{{ $pesanan->created_at->format('d F Y') }}</td>
                        <td class="p-3">{{ $pesanan->durasi_sewa }} Hari</td>
                        <td class="p-3">{{ $pesanan->pembayaran->metode_pembayaran ?? 'tidak diketahui'  }}</td>
                        <td class="p-3">
                            <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full">
                                {{ $pesanan->pembayaran->status_pembayaran ?? 'tidak diketahui' }}
                            </span>
                        </td>
                        <td class="p-3">
                            <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full">
                                {{ $pesanan->status_pemesanan }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html> --}}
