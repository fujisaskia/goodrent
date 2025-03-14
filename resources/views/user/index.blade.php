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

    <!-- Tailwind CSS -->
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css'])

</head>
{{-- bg-gradient-to-b from-emerald-100 to-slate-200 --}}
<body class="bg-slate-100 pt-20">

    {{--Navbar  --}}
    @include('components.navbar-user')

    <!-- Banner -->
    <div class="max-w-5xl mx-auto">
        <div
            class="flex flex-col md:flex-row m-4 p-6 h-80 md:h-52 bg-gradient-to-r from-cyan-500 to-cyan-200 rounded-lg justify-between items-center shadow-xl relative overflow-hidden">
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-700/20 to-emerald-500/10"></div>

            <!-- Pattern -->
            <div class="absolute inset-0 bg-repeat opacity-20"
                style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9IiMwMDAwMDAiLz48ZyBvcGFjaXR5PSIwLjEiPjxjaXJjbGUgY3g9IjEwIiBjeT0iMTAiIHI9IjEwIiBmaWxsPSIjZmZmIi8+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMTAiIGZpbGw9IiNmZmYiLz48Y2lyY2xlIGN4PSI1MCIgY3k9IjUwIiByPSIxMCIgZmlsbD0iI2ZmZiIvPjwvZz48L3N2Zz4=');">
            </div>

            <!-- Content -->
            <div class="flex-1 text-center md:text-left z-10">
                <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg">Selamat Datang, {{ Auth::user()->name }}👋</h1>
                <q class="text-gray-100 max-w-md text-lg italic">
                    Siap main tanpa batas? Sewa PS & barang favoritmu sekarang!
                </q>
            </div>

            <!-- Ilustrasi Dashboard -->
            <div class="flex z-10">
                <img src="{{ asset('assets/play.png') }}" alt="Illustration Dashboard"
                    class="animate-smallbounce w-72 drop-shadow-lg hover:drop-shadow-xl transition-all duration-300">
            </div>

            <!-- Glow Effect -->
            <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-yellow-300 rounded-full opacity-20 blur-2xl"></div>
            <div class="absolute -top-20 -left-20 w-64 h-64 bg-yellow-300 rounded-full opacity-20 blur-2xl"></div>
        </div>
    </div>


    <!-- Search Bar -->
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-center items-center space-x-3 my-8 mx-4">
            <input type="search" placeholder="Cari Produk yang dibutuhkan..."
                class="w-2/3 px-4 py-3 border md:border-gray-300 border-gray-400 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-emerald-200">
            <button class="py-3 px-4 bg-emerald-600 rounded-full shadow-xl text-white focus:scale-95 duration-300">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </div>

    <!-- Produk -->
    <section class="pb-24">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mx-5">
                <div class="bg-white p-3 rounded-md shadow-md hover:shadow-2xl hover:shadow-emerald-200 duration-300">
                    <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="PS5"
                        class="w-full rounded">
                    <h3 class="mt-2 font-bold">PS5</h3>
                    <p class="text-red-500 font-bold">25,000 / jam</p>
                    <a href="/goodrent/lihat-produk/" class="bg-emerald-500 hover:bg-emerald-600 text-white py-1.5 rounded-md">
                        <button class="w-full mt-3 font-semibold text-sm group-focus:scale-95 duration-300">
                            Pilih
                        </button>
                    </a>
                </div>
                <div class="bg-white p-3 rounded-md shadow-md hover:shadow-2xl hover:shadow-emerald-200 duration-300">
                    <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="PS5"
                        class="w-full rounded">
                    <h3 class="mt-2 font-bold">PS5</h3>
                    <p class="text-red-500 font-bold">25,000 / jam</p>
                    <a href="/goodrent/lihat-produk/" class="bg-emerald-500 hover:bg-emerald-600 text-white py-1.5 rounded-md">
                        <button class="w-full mt-3 font-semibold text-sm group-focus:scale-95 duration-300">
                            Pilih
                        </button>
                    </a>
                </div>
                <div class="bg-white p-3 rounded-md shadow-md hover:shadow-2xl hover:shadow-emerald-200 duration-300">
                    <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="PS5"
                        class="w-full rounded">
                    <h3 class="mt-2 font-bold">PS5</h3>
                    <p class="text-red-500 font-bold">25,000 / jam</p>
                    <a href="/goodrent/lihat-produk/" class="bg-emerald-500 hover:bg-emerald-600 text-white py-1.5 rounded-md">
                        <button class="w-full mt-3 font-semibold text-sm group-focus:scale-95 duration-300">
                            Pilih
                        </button>
                    </a>
                </div>
                <div class="bg-white p-3 rounded-md shadow-md hover:shadow-2xl hover:shadow-emerald-200 duration-300">
                    <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="PS5"
                        class="w-full rounded">
                    <h3 class="mt-2 font-bold">PS5</h3>
                    <p class="text-red-500 font-bold">25,000 / jam</p>
                    <a href="/goodrent/lihat-produk/" class="bg-emerald-500 hover:bg-emerald-600 text-white py-1.5 rounded-md">
                        <button class="w-full mt-3 font-semibold text-sm group-focus:scale-95 duration-300">
                            Pilih
                        </button>
                    </a>
                </div>
                <div class="bg-white p-3 rounded-md shadow-md hover:shadow-2xl hover:shadow-emerald-200 duration-300">
                    <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="PS5"
                        class="w-full rounded">
                    <h3 class="mt-2 font-bold">PS5</h3>
                    <p class="text-red-500 font-bold">25,000 / jam</p>
                    <a href="/goodrent/lihat-produk/" class="bg-emerald-500 hover:bg-emerald-600 text-white py-1.5 rounded-md">
                        <button class="w-full mt-3 font-semibold text-sm group-focus:scale-95 duration-300">
                            Pilih
                        </button>
                    </a>
                </div>
                <div class="bg-white p-3 rounded-md shadow-md hover:shadow-2xl hover:shadow-emerald-200 duration-300">
                    <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="PS5"
                        class="w-full rounded">
                    <h3 class="mt-2 font-bold">PS5</h3>
                    <p class="text-red-500 font-bold">25,000 / jam</p>
                    <a href="/goodrent/lihat-produk/" class="bg-emerald-500 hover:bg-emerald-600 text-white py-1.5 rounded-md">
                        <button class="w-full mt-3 font-semibold text-sm group-focus:scale-95 duration-300">
                            Pilih
                        </button>
                    </a>
                </div>
                <div class="bg-white p-3 rounded-md shadow-md hover:shadow-2xl hover:shadow-emerald-200 duration-300">
                    <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="PS5"
                        class="w-full rounded">
                    <h3 class="mt-2 font-bold">PS5</h3>
                    <p class="text-red-500 font-bold">25,000 / jam</p>
                    <a href="/goodrent/lihat-produk/" class="bg-emerald-500 hover:bg-emerald-600 text-white py-1.5 rounded-md">
                        <button class="w-full mt-3 font-semibold text-sm group-focus:scale-95 duration-300">
                            Pilih
                        </button>
                    </a>
                </div>
                <div class="bg-white p-3 rounded-md shadow-md hover:shadow-2xl hover:shadow-emerald-200 duration-300">
                    <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="PS5"
                        class="w-full rounded">
                    <h3 class="mt-2 font-bold">PS5</h3>
                    <p class="text-red-500 font-bold">25,000 / jam</p>
                    <a href="/goodrent/lihat-produk/" class="bg-emerald-500 hover:bg-emerald-600 text-white py-1.5 rounded-md">
                        <button class="w-full mt-3 font-semibold text-sm group-focus:scale-95 duration-300">
                            Pilih
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer-user')


</html>

