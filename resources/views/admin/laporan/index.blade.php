@extends('layouts/admin')

@section('title', 'Laporan GoodRent')

@section('content')

    <div class="mx-auto p-2">
        <h2 class="flex space-x-3 text-3xl font-bold mb-4 items-center justify-center md:justify-start">
            <i class="fa-solid fa-folder-open text-emerald-800"></i>
            <span>Laporan GoodRent</span>
        </h2>
        
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row justify-between mb-4">
                <div class="flex space-x-4 mb-4 md:mb-0">
                    <input type="search" placeholder="Cari Pelanggan"
                        class="border p-3 rounded-lg w-60 focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                    <button class="py-3 px-4 bg-emerald-600 rounded-full text-white focus:scale-95 duration-300">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                <div class="flex flex-col md:flex-row justify-between space-x-4">
                    <div class="flex space-x-2 mb-4 md:mb-0">
                        <!-- Masa Awal -->
                        <input type="text" id="awal-laporan" name="awal_laporan"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            placeholder="Pilih tanggal awal" required>
                        <span class="p-2">-</span>
                        <!-- Masa Akhir -->
                        <input type="text" id="akhir-laporan" name="akhir_laporan"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            placeholder="Pilih tanggal akhir" required>
                    </div>
                    <div class="flex justify-end">
                        <a href="" class="p-3 bg-yellow-500 rounded-xl text-white focus:scale-95 duration-300">
                           Cetak
                        </a>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto lg:overflow-visible">
                <table class="w-full border-collapse border rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-500 text-white uppercase">
                            <th class="p-3">no</th>
                            <th class="p-3">Nama Pelanggan</th>
                            <th class="p-3">Tanggal Pesan</th>
                            <th class="p-3">Jenis PS</th>
                            <th class="p-3">durasi sewa</th>
                            <th class="p-3">Nomor PS</th>
                            <th class="p-3">Metode Bayar</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr class="border-b text-center hover:bg-gray-50">
                            <td class="p-3 ">1</td>
                            <td class="p-3 capitalize">hilal ahmad</td>
                            <td class="p-3">1 Maret, 2025</td>
                            <td class="p-3">PS-5</td>
                            <td class="p-3">5 Jam</td>
                            <td class="p-3">PS5-001</td>
                            <td class="p-3">Langsung</td>
                            <td class="p-3 flex items-center justify-center gap-2">
                                {{-- button lihat --}}
                                <a href="">
                                    @include('components.crud.read')
                                </a>
                            </td>
                        </tr>
                        <tr class="border-b text-center hover:bg-gray-50">
                            <td class="p-3 ">2</td>
                            <td class="p-3 capitalize">Fitri Amaliah</td>
                            <td class="p-3">5 Maret, 2025</td>
                            <td class="p-3">PS-5</td>
                            <td class="p-3">3 Jam</td>
                            <td class="p-3">PS5-004</td>
                            <td class="p-3">Online</td>
                            <td class="p-3 flex items-center justify-center gap-2">
                                {{-- button lihat --}}
                                <a href="">
                                    @include('components.crud.read')
                                </a>
                            </td>
                        </tr>
                        <tr class="border-b text-center hover:bg-gray-50">
                            <td class="p-3 ">3</td>
                            <td class="p-3 capitalize">Fuji</td>
                            <td class="p-3">6 Maret, 2025</td>
                            <td class="p-3">PS-5</td>
                            <td class="p-3">3 Jam</td>
                            <td class="p-3">PS5-005</td>
                            <td class="p-3">Online</td>
                            <td class="p-3 flex items-center justify-center gap-2">
                                {{-- button lihat --}}
                                <a href="">
                                    @include('components.crud.read')
                                </a>
                            </td>
                        </tr>
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
            minDate: new Date(),
        });
    </script>
@endsection
