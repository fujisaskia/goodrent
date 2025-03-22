<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cek Keranjang</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Font Awesome CDN Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- Calendar Format --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script> <!-- Lokal Bahasa Indonesia -->

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css'])

</head>
{{-- bg-gradient-to-b from-emerald-100 to-slate-200 --}}

<body class="min-h-screen bg-gradient-to-b from-emerald-50 to-slate-200 pt-20 text-sm">

    {{-- Navbar --}}
    @include('components.navbar-user')


    {{-- Konten di Sini --}}
    <div class="max-w-5xl mx-auto py-8 mb-10 md:mb-24">
        <div class="bg-white border p-4 rounded-lg shadow-lg mx-4">

            {{-- title page & search --}}
            <div class="flex flex-col md:flex-row justify-between mb-5">
                <h2 class="text-gray-700 text-2xl font-semibold text-center md:text-start mb-2 md:mb-0">Cek Keranjang</h2>
                <div class="flex justify-center items-center space-x-2">
                    <input type="search" placeholder="Cari"
                        class="w-full px-4 py-3 md:py-2 border md:border-gray-200 border-gray-400 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-emerald-100">
                    <button
                        class=" px-4 md:px-3 py-3 md:py-2 bg-emerald-600 rounded-full shadow-xl text-white focus:scale-95 duration-300">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>

            {{-- card --}}
            <div class="">
                <div
                    class="flex space-x-3 p-2 border-b border-gray-200 hover:bg-gray-50 hover:shadow-md duration-200">
                    <div class="flex">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                            alt="" class="w-14 h-14 md:w-16 md:h-16 rounded border border-gray-300">
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <div class="">
                                <h3 class="font-semibold">Play Station 5</h3>
                                <h5 class="text-gray-700 text-xs">06 Maret, 2025 - 07 Maret, 2025</h5>
                            </div>

                            <form action="" method="" class="">
                                <button type="submit" class="text-xs py-1 px-2 md:px-3 text-white font-semibold bg-red-500 hover:bg-red-600 text-center">Hapus</button>
                            </form>
                        </div>
                        <div class="flex justify-between font-semibold mt-3">
                            <div class="">
                                <h3 class="">2 Hari</h3>
                            </div>

                            <div class="">
                                <h3 class="">Rp 50,000</h3>
                            </div>
                        </div>
                    </div>

                </div>
                <div
                    class="flex space-x-3 p-2 border-b border-gray-200 hover:bg-gray-50 hover:shadow-md duration-200">
                    <div class="flex">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                            alt="" class="w-14 h-14 md:w-16 md:h-16 rounded border border-gray-300">
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <div class="">
                                <h3 class="font-semibold">Play Station 5</h3>
                                <h5 class="text-gray-700 text-xs">06 Maret, 2025 - 07 Maret, 2025</h5>
                            </div>

                            <form action="" method="" class="">
                                <button type="submit" class="text-xs py-1 px-2 md:px-3 text-white font-semibold bg-red-500 hover:bg-red-600 text-center">Hapus</button>
                            </form>
                        </div>
                        <div class="flex justify-between font-semibold mt-3">
                            <div class="">
                                <h3 class="">2 Hari</h3>
                            </div>

                            <div class="">
                                <h3 class="">Rp 50,000</h3>
                            </div>
                        </div>
                    </div>

                </div>
                <div
                    class="flex space-x-3 p-2 border-b border-gray-200 hover:bg-gray-50 hover:shadow-md duration-200">
                    <div class="flex">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                            alt="" class="w-14 h-14 md:w-16 md:h-16 rounded border border-gray-300">
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <div class="">
                                <h3 class="font-semibold">Play Station 5</h3>
                                <h5 class="text-gray-700 text-xs">06 Maret, 2025 - 07 Maret, 2025</h5>
                            </div>

                            <form action="" method="" class="">
                                <button type="submit" class="text-xs py-1 px-2 md:px-3 text-white font-semibold bg-red-500 hover:bg-red-600 text-center">Hapus</button>
                            </form>
                        </div>
                        <div class="flex justify-between font-semibold mt-3">
                            <div class="">
                                <h3 class="">2 Hari</h3>
                            </div>

                            <div class="">
                                <h3 class="">Rp 50,000</h3>
                            </div>
                        </div>
                    </div>

                </div>
                <div
                    class="flex space-x-3 p-2 border-b border-gray-200 hover:bg-gray-50 hover:shadow-md duration-200">
                    <div class="flex">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                            alt="" class="w-14 h-14 md:w-16 md:h-16 rounded border border-gray-300">
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <div class="">
                                <h3 class="font-semibold">Play Station 5</h3>
                                <h5 class="text-gray-700 text-xs">06 Maret, 2025 - 07 Maret, 2025</h5>
                            </div>

                            <form action="" method="" class="">
                                <button type="submit" class="text-xs py-1 px-2 md:px-3 text-white font-semibold bg-red-500 hover:bg-red-600 text-center">Hapus</button>
                            </form>
                        </div>
                        <div class="flex justify-between font-semibold mt-3">
                            <div class="">
                                <h3 class="">2 Hari</h3>
                            </div>

                            <div class="">
                                <h3 class="">Rp 50,000</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ringkasan harga --}}
            <div class="sticky bottom-0 bg-white">
                <div class="flex flex-col md:flex-row justify-between items-center p-3 border-t-2 border-gray-200 mb-2 duration-200">
                    <!-- Bagian Harga -->
                    <div class="flex w-full justify-between md:justify-start space-x-2 text-xl md:text-lg">
                        <h3 class="font-semibold capitalize text-gray-700">total :</h3>
                        <h3 class="text-red-700 font-bold">Rp 100,000,000</h3>
                    </div>
                    <!-- Tombol Checkout -->
                    <div class="flex w-full justify-end mt-3 md:mt-0">
                        <button class="bg-gray-800 hover:bg-gray-900 shadow-xl hover:shadow-sm text-white rounded-md px-6 py-3 w-36  focus:scale-95 duration-200">
                            <span>Checkout</span>
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

</body>

</html>
