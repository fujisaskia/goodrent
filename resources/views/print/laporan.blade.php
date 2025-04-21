<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Sewa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="container mx-auto">
        <div class="flex flex-col space-y-3 mb-6 justify-center items-center mx-auto">
            <img src="{{ asset('assets/logo-fixed.png') }}" alt="" class="w-40 h-40">
            <h1 class="text-3xl font-bold mb-4">Laporan Penyewaan</h1>
        </div>

        <table class="min-w-full table-auto border border-gray-300 bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-500 text-white uppercase">
                    <th class="p-3">No</th>
                    <th class="p-3">Nama Pelanggan</th>
                    <th class="p-3">Tanggal Sewa</th>
                    <th class="p-3">Durasi Sewa</th>
                    <th class="p-3">Metode Bayar</th>
                    <th class="p-3">Status Bayar</th>
                    <th class="p-3">Status Pesanan</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b text-center">
                    <td class="p-3">1</td>
                    <td class="p-3">Budi Santoso</td>
                    <td class="p-3">23 Mei, 2025 - 27 Mei, 2025</td>
                    <td class="p-3">3 Hari</td>
                    <td class="p-3">Transfer</td>
                    <td class="p-3">
                        <span class="bg-green-200 text-green-800 px-2 py-1 rounded">Lunas</span>
                    </td>
                    <td class="p-3">
                        <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded">Selesai</span>
                    </td>
                </tr>
                <tr class="border-b text-center">
                    <td class="p-3">2</td>
                    <td class="p-3">Siti Nurhaliza</td>
                    <td class="p-3">23 Mei, 2025 - 24 Mei, 2025</td>
                    <td class="p-3">1 Hari</td>
                    <td class="p-3">Cash</td>
                    <td class="p-3">
                        <span class="bg-red-200 text-red-800 px-2 py-1 rounded">Belum Lunas</span>
                    </td>
                    <td class="p-3">
                        <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded">Diproses</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
