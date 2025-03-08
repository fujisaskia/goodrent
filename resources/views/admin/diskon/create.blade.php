<!-- resources/views/home.blade.php -->
@extends('layouts/admin')

@section('title', 'Tambah Diskon')

@section('content')

    <div class="max-w-lg mx-auto p-8 bg-white rounded-lg shadow-lg border border-gray-400 md:border-none">
        <h1 class="text-lg md:text-xl font-semibold mb-6 pb-2 border-b text-center">Tambah Diskon Baru</h1>

        <form action="" method="POST">
            @csrf
            <div class="space-y-4">
                <div class="">
                    <label for="" class="block text-gray-700 mb-2 capitalize">Nama Diskon</label>
                    <input type="text" name="" placeholder="silahkan isi nama diskon"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>

                <div class="">
                    <label for="" class="block text-gray-700 mb-2 capitalize">kode diskon</label>
                    <input type="number" name="" placeholder="buat kode diskon"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>

                <div class="">
                    <label for="" class="block text-gray-700 mb-2 capitalize">jenis diskon</label>
                    <input type="number" name=""
                        placeholder="Silakan isi jenis diskon: % (Persentase) atau Rp (Nominal)"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>

                <div class="">
                    <label for="" class="block text-gray-700 mb-2 capitalize">besar diskon</label>
                    <input type="number" name="" placeholder="silahkan isi besar diskon"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>
                <div class="">
                    <label for="" class="block text-gray-700 mb-2 capitalize">masa berlaku</label>
                    <div class="flex space-x-4">
                        <!-- Masa Awal -->
                        <input type="text" id="masa-awal" name="masa_awal"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            placeholder="Pilih tanggal awal" required>
                        <!-- Masa Akhir -->
                        <input type="text" id="masa-akhir" name="masa_akhir"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            placeholder="Pilih tanggal akhir" required>
                    </div>
                </div>
            </div>

            <div class="flex space-x-3 justify-end mt-6">
                <a href=""
                    class="flex space-x-2 text-white bg-red-500 hover:bg-red-600 focus:bg-red-600 p-2 rounded-lg">
                    <p>Batalkan</p>
                </a>
                <button type="submit"
                    class="flex space-x-2 text-white bg-green-600 hover:bg-green-700 focus:bg-green-600 p-2 rounded-lg">
                    <i class="fa-solid fa-plus"></i>
                    <p>Tambah Diskon</p>
                </button>
            </div>
        </form>


    </div>
    
    <script>
        flatpickr("#masa-awal", {
            dateFormat: "d F Y",
            locale: "id", // Set lokal ke Bahasa Indonesia
            minDate: "today",
            onChange: function(selectedDates, dateStr) {
                masaAkhir.set("minDate", dateStr); // Mencegah tanggal akhir sebelum tanggal awal
            }
        });
    
        let masaAkhir = flatpickr("#masa-akhir", {
            dateFormat: "d F Y",
            locale: "id", // Set lokal ke Bahasa Indonesia
            minDate: "today",
            minDate: new Date(),
        });
    </script>
@endsection
