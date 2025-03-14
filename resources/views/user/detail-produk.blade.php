<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GoodRent | Produk</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Data AOS Animate --}}
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Font Awesome CDN Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- Calendar Format --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script> <!-- Lokal Bahasa Indonesia -->

    <!-- Tailwind CSS -->
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css'])

</head>
{{-- bg-gradient-to-b from-emerald-100 to-slate-200 --}}

<body class=" bg-gradient-to-b from-emerald-50 to-slate-200 pt-20">

    {{-- Navbar --}}
    @include('components.navbar-user')


    {{-- Konten di Sini --}}
    <div class="max-w-5xl mx-auto py-8">
        <div class="bg-white border p-6 rounded-lg shadow-lg mx-4">
            <div class="grid lg:grid-cols-2 gap-6 lg:gap-12">
                <div>
                    <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="PS5"
                        class="w-[95%] rounded-lg mx-auto">
                    <div class="flex gap-2 my-4">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                            alt="PS5" class="w-20 rounded-lg hover:opacity-80">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                            alt="PS5" class="w-20 rounded-lg hover:opacity-80">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                            alt="PS5" class="w-20 rounded-lg hover:opacity-80">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                            alt="PS5" class="w-20 rounded-lg hover:opacity-80">
                    </div>
                    <h3 class="block lg:hidden text-2xl font-bold">PlayStation 5 (PS5)</h3>
                    <p class="block lg:hidden text-2xl text-green-600 font-semibold mb-5">Harga Sewa: Rp 30,000</p>
                    <h3 class="text-lg font-semibold py-4 border-t-2 border-gray-300">Deskripsi Produk :</h3>
                    <p class="text-gray-600 text-sm mt-2">
                        PlayStation 5 (PS5) adalah konsol game generasi terbaru dari Sony yang menawarkan performa luar
                        biasa dengan teknologi canggih. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum
                        minima perspiciatis, illum ullam aliquam harum magnam labore facere ipsam quisquam totam
                        blanditiis quo, eligendi neque, libero ad iste accusantium omnis explicabo assumenda
                        reprehenderit! Quos itaque quisquam, totam placeat voluptatem nemo.
                    </p>
                </div>
                <div class="">
                    <div>
                        <h3 class="hidden lg:block text-2xl font-bold">PlayStation 5 (PS5)</h3>
                        <p class="hidden lg:block text-2xl text-green-600 font-semibold">Harga Sewa: Rp 30,000</p>
                        <div class="space-y-2 rounded-lg mt-2">
                            <h3 class="font-semibold">Durasi Sewa</h3>
                            <div class="flex justify-between bg-gray-100 p-3 rounded-md border border-gray-300">
                                <span>12 jam</span> <span class="font-bold text-red-700">Rp 30,000</span>
                            </div>
                            <div class="flex justify-between bg-gray-100 p-3 rounded-md border border-gray-300">
                                <span>1 Hari</span> <span class="font-bold text-red-700">Rp 40,000</span>
                            </div>
                            <div class="flex justify-between bg-gray-100 p-3 rounded-md border border-gray-300">
                                <span>2 Hari</span> <span class="font-bold text-red-700">Rp 40,000</span>
                            </div>
                            <div class="flex justify-between bg-gray-100 p-3 rounded-md border border-gray-300">
                                <span>3 Hari</span> <span class="font-bold text-red-700">Rp 40,000</span>
                            </div>
                        </div>
                        <p class="text-red-600 text-sm bg-red-100 p-2 rounded-md mt-1.5 font-semibold">*Harga sewa belum termasuk biaya pengiriman</p>
                    </div>

                    <div class="bg-white shadow-lg shadow-emerald-100 border border-gray-400 lg:border-gray-200 p-4 rounded-lg mt-8 text-sm">
                        <h3 class="text-xl font-bold text-center mb-6">Form Sewa</h3>
                        <form>
                            <div class="mb-3">
                                <label class="block text-xs font-semibold text-gray-600">Durasi Sewa :</label>
                                <select name="" id=""
                                    class="w-full p-3 rounded border mt-1 focus:outline-none focus:ring focus:ring-emerald-100">
                                    <option value="">Pilih Durasi</option>
                                    <option value="">Setengah Hari</option>
                                    <option value="">1 Hari</option>
                                    <option value="">2 Hari</option>
                                    <option value="">3 Hari</option>
                                </select>
                            </div>

                            <div class="flex space-x-3 mb-3">
                                <div class="w-full">
                                    <label class="block text-xs font-semibold text-gray-600">Tanggal Mulai :</label>
                                    <input type="date" id="mulai-sewa" placeholder="Pilih tanggal sewa"
                                        class="w-full p-3 rounded border mt-1 focus:outline-none focus:ring focus:ring-emerald-100">
                                </div>

                                <div class="w-full">
                                    <label class="block text-xs font-semibold text-gray-600">Tanggal Selesai :</label>
                                    <input type="date" id="selesai-sewa" placeholder="Tanggal akhir sewa"
                                        class="w-full p-3 rounded border mt-1 focus:outline-none focus:ring focus:ring-emerald-100">
                                </div>

                            </div>

                            <button class="w-full mt-8 bg-gray-800 hover:bg-gray-900 text-white p-4 rounded">Sewa
                                Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Footer --}}
    @include('components.footer-user')

</html>
{{-- 
<script>
    flatpickr("#mulai-sewa", {
        dateFormat: "d F Y",
        locale: "id", // Set lokal ke Bahasa Indonesia
        minDate: "today",
        onChange: function(selectedDates, dateStr) {
            masaAkhir.set("minDate", dateStr); // Mencegah tanggal akhir sebelum tanggal awal
        }
    });

    let masaAkhir = flatpickr("#selesai-sewa", {
        dateFormat: "d F Y",
        locale: "id", // Set lokal ke Bahasa Indonesia
        minDate: "today",
        minDate: new Date(),
    });
</script> --}}
