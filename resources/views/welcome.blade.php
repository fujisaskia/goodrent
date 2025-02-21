<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GoodRent | Rental Lebih Mudah</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Data AOS Animate --}}
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Font Awesome CDN Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-xs md:text-sm">
    {{-- Navbar --}}
    <nav id="navbar" class="fixed top-0 left-0 w-full bg-transparent shadow-sm py-3 z-20">
        <div class="max-w-6xl mx-4 lg:mx-auto flex justify-between items-center py-2">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <span class="font-extrabold text-xl text-emerald-600">GoodRent</span>
            </div>
            <div id="menu-button" class="flex lg:hidden">
                <button id="menu-open" class="transition-all duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="size-8 text-emerald-600 hover:text-emerald-600">
                        <path fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 0 1 2.75 4h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 4.75Zm7 10.5a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5a.75.75 0 0 1-.75-.75ZM2 10a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 10Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <button id="menu-close" class="hidden transition-all duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8 text-emerald-600 hover:text-emerald-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>


            <!-- Menu Items -->
            <div class="hidden lg:flex space-x-6">
                <a id="menu-beranda" href="#beranda" class="p-2 text-white hover:text-emerald-600">Beranda</a>
                <a id="menu-tentang" href="#tentang" class="p-2 text-white hover:text-emerald-600">Tentang</a>
                <a id="menu-produk" href="#produk" class="p-2 text-white hover:text-emerald-600">Produk</a>
                {{-- <a id="menu-contact" href="#kontak" class="p-2 text-white hover:text-emerald-600">Kontak</a> --}}
            </div>

            <!-- Button -->
            <div class="hidden lg:flex items-center space-x-2">
                {{-- button masuk --}}
                <a href="/login"
                    class="flex space-x-1 items-center font-semibold py-2 px-8 text-white bg-emerald-600 hover:bg-emerald-700 focus:scale-95 rounded-xl duration-300">
                    <span>Masuk</span>
                </a>
                {{-- button daftar --}}
                <a href="/register"
                    class="flex space-x-1 items-center font-semibold py-2 px-8 text-white border-2 border-white focus:scale-95 rounded-xl duration-300">
                    <span>Daftar</span>
                </a>
            </div>
        </div>
    </nav>

    {{-- mobile menu --}}
    <div class="items-center justify-center fixed z-50 w-full px-4 mt-16">
        <!-- Dropdown (Mobile Menu) -->
        <div id="dropdown-menu"
            class="items-center top-16 my-4 w-full text-black border-2 border-emerald-700 hidden lg:hidden bg-white rounded-xl py-4 opacity-0 scale-90 transition-all duration-300 ease-in-out">
            <ul class="flex flex-col text-base font-medium w-full space-y-2">
                <li><a href="#beranda" class="block py-4 px-6 border-b border-gray-50 hover:bg-slate-100">Beranda</a>
                </li>
                <li><a href="#tentang" class="block py-4 px-6 border-b border-gray-50 hover:bg-slate-100">Tentang</a>
                </li>
                <li><a href="#produk" class="block py-4 px-6 border-b border-gray-50 hover:bg-slate-100">Produk</a>
                {{-- </li>
                <li><a href="#kontak" class="block py-4 px-6 border-b border-gray-50 hover:bg-slate-100">Kontak</a>
                </li> --}}
                <hr class="w-1/2 bg-gray-600 mx-auto text-center">
            </ul>
            <div class="flex justify-center py-4 px-6">
                <a href="/login"
                    class="flex justify-center text-sm items-center bg-emerald-600 text-white font-semibold hover:bg-white hover:text-emerald-500 py-4 w-full rounded-full hover:shadow-lg">
                    <span>Masuk</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Hero Section --}}
    <section id="beranda" class="relative w-full h-screen bg-fixed bg-center" 
        style="background-image: url('https://i.pinimg.com/736x/fc/43/90/fc4390ab742a1b9f148605e67b08ba36.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <div data-aos="fade-up" data-aos-duration="1000"  class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-6">
            <h1 class="text-4xl md:text-6xl font-bold">Sewa Barang Mudah & Terpercaya</h1>
            <p class="mt-4 text-lg md:text-xl">Dapatkan barang sewaan berkualitas dengan harga terbaik</p>
            <a href="/login" data-aos="fade-up" data-aos-duration="1500"
                class="mt-6">
                <button class=" bg-emerald-600 hover:bg-emerald-700 text-white py-3 px-6 rounded-lg font-semibold text-sm focus:scale-95 duration-300">
                    <span>Sewa Sekarang</span>
                </button>
            </a>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="tentang" class="relative bg-gradient-to-b from-emerald-100 to-slate-50 py-16 px-6 text-center">
        <div class="max-w-5xl mx-auto">
            <div class="" data-aos="fade-up" data-aos-duration="1000" >
                <h2 class="text-4xl font-extrabold text-emerald-700 mb-4">Tentang <span class="text-gray-800">GoodRent</span></h2>
                <p class="text-gray-700 text-lg leading-relaxed max-w-3xl mx-auto">
                    GoodRent adalah platform rental PlayStation yang memudahkan kamu menyewa PS tanpa ribet!  
                    Nikmati berbagai pilihan konsol <span class="font-semibold">PS4 & PS5</span> dengan harga terjangkau, tanpa perlu keluar rumah.
                </p>
    
                <!-- Decorative Line -->
                <div class="w-20 h-1 bg-emerald-500 mx-auto my-6 rounded-full"></div>
            </div>

            <h3 class="text-2xl font-bold text-gray-800 mb-8" data-aos="fade-up" data-aos-duration="1000" >Kenapa Pilih <span class="text-emerald-600">GoodRent?</span></h3>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Card 1 -->
                <div class="bg-white shadow-xl rounded-2xl p-6 flex flex-col items-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl group" data-aos="fade-up" data-aos-duration="1200" >
                    <i class="fa-solid fa-clock-rotate-left text-5xl text-emerald-600 mb-4 group-hover:-rotate-180 duration-500"></i>
                    <h3 class="text-xl font-semibold text-gray-800">Sewa Mudah & Cepat</h3>
                    <p class="text-gray-600 text-sm">Pilih, pesan, dan nikmati tanpa ribet.</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white shadow-xl rounded-2xl p-6 flex flex-col items-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl group" data-aos="fade-up" data-aos-duration="1500" >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-emerald-600 mb-4 group-hover:scale-110 duration-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                    </svg>                  
                    <h3 class="text-xl font-semibold text-gray-800">Kualitas Terbaik</h3>
                    <p class="text-gray-600 text-sm">Konsol selalu bersih & terawat.</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white shadow-xl rounded-2xl p-6 flex flex-col items-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl group" data-aos="fade-up" data-aos-duration="2000" >
                    <i class="fa-solid fa-truck-fast text-5xl text-emerald-600 mb-4 group-hover:translate-x-2 duration-200"></i>
                    <h3 class="text-xl font-semibold text-gray-800">Layanan Antar-Jemput</h3>
                    <p class="text-gray-600 text-sm">Praktis tanpa repot, langsung ke rumahmu!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How to Order Section -->
    <section class="relative bg-slate-50 py-16 px-6 text-center">
        <div class="max-w-5xl mx-auto">
            <div class="" data-aos="fade-up" data-aos-duration="1000" >
                <h2 class="text-3xl font-extrabold text-gray-800 mb-4">Bagaimana Cara Menyewa di <span class="text-emerald-700">GoodRent ?</span></h2>
                <p class="text-gray-700 text-lg leading-relaxed max-w-3xl mx-auto">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At vero, 
                    deleniti autem sed quos in aliquid odio atque quis totam?
                </p>
    
                <!-- Decorative Line -->
                <div class="w-20 h-1 bg-emerald-500 mx-auto my-6 rounded-full"></div>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Card 1 -->
                <div class="bg-white shadow-xl rounded-2xl p-6 flex flex-col items-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl group" data-aos="fade-up" data-aos-duration="1200" >
                    <i class="fa-solid fa-clock-rotate-left text-5xl text-emerald-600 mb-4 group-hover:-rotate-180 duration-500"></i>
                    <h3 class="text-base font-semibold text-gray-800">Sewa Mudah & Cepat</h3>
                    <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, natus.</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-emerald-600 shadow-xl rounded-2xl p-6 flex flex-col items-center text-center text-white transition-all duration-300 hover:scale-105 hover:shadow-2xl group" data-aos="fade-up" data-aos-duration="1500" >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12  mb-4 group-hover:scale-110 duration-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                    </svg>                  
                    <h3 class="text-base font-semibold ">Kualitas Terbaik</h3>
                    <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, natus.</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white shadow-xl rounded-2xl p-6 flex flex-col items-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl group" data-aos="fade-up" data-aos-duration="2000" >
                    <i class="fa-solid fa-truck-fast text-5xl text-emerald-600 mb-4 group-hover:translate-x-2 duration-200"></i>
                    <h3 class="text-base font-semibold text-gray-800">Layanan Antar-Jemput</h3>
                    <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, natus.</p>
                </div>

                <!-- Card 4 -->
                <div class="bg-emerald-600 shadow-xl rounded-2xl p-6 flex flex-col items-center text-center text-white transition-all duration-300 hover:scale-105 hover:shadow-2xl group" data-aos="fade-up" data-aos-duration="2000" >
                    <i class="fa-solid fa-truck-fast text-5xl  mb-4 group-hover:translate-x-2 duration-200"></i>
                    <h3 class="text-base font-semibold ">Layanan Antar-Jemput</h3>
                    <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, natus.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Product Section --}}
    <section id="produk" class="relative bg-gradient-to-t from-emerald-100 to-slate-50 py-16 px-6 text-center">
        <div class="max-w-5xl mx-auto">
            <h3 data-aos="fade-up" data-aos-duration="1000"  class="text-3xl font-bold text-gray-800 mb-8 capitalize">cari barang <span class="text-emerald-600">kebutuhanmu</span></h3>
            <div data-aos="fade-up" data-aos-duration="1200"  class="flex space-x-2 w-2/3 md:w-1/3 mx-auto mb-6">
                <input type="search" placeholder="Cari produk..." class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <button class="p-3 bg-emerald-600 rounded-full text-white focus:scale-95 duration-300">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 text-sm md:text-xs">
                {{-- Card Product --}}
                <div  data-aos="fade-up" data-aos-duration="1500" class="">
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-2xl p-4 text-start duration-300">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="PlayStation" class="w-full h-40 object-cover rounded-md">
                        <h3 class="mt-4 text-base md:text-lg font-semibold">PS5 Standard</h3>
                        <p class="text-orange-600 font-semibold">Sewa Rp50.000/jam</p>
                        <button class="mt-4 w-full bg-gradient-to-l from-emerald-600 to-emerald-800 text-white py-2 rounded-lg hover:bg-emerald-700 hover:scale-105 focus:scale-95 duration-300">Sewa Sekarang</button>
                    </div>
                </div>
                <div  data-aos="fade-up" data-aos-duration="1500" class="">
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-2xl p-4 text-start duration-300">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="PlayStation" class="w-full h-40 object-cover rounded-md">
                        <h3 class="mt-4 text-base md:text-lg font-semibold">PS5 Standard</h3>
                        <p class="text-orange-600 font-semibold">Sewa Rp50.000/jam</p>
                        <button class="mt-4 w-full bg-gradient-to-l from-emerald-600 to-emerald-800 text-white py-2 rounded-lg hover:bg-emerald-700 hover:scale-105 focus:scale-95 duration-300">Sewa Sekarang</button>
                    </div>
                </div>
                <div  data-aos="fade-up" data-aos-duration="1500" class="">
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-2xl p-4 text-start duration-300">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="PlayStation" class="w-full h-40 object-cover rounded-md">
                        <h3 class="mt-4 text-base md:text-lg font-semibold">PS5 Standard</h3>
                        <p class="text-orange-600 font-semibold">Sewa Rp50.000/jam</p>
                        <button class="mt-4 w-full bg-gradient-to-l from-emerald-600 to-emerald-800 text-white py-2 rounded-lg hover:bg-emerald-700 hover:scale-105 focus:scale-95 duration-300">Sewa Sekarang</button>
                    </div>
                </div>
                <div  data-aos="fade-up" data-aos-duration="1500" class="">
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-2xl p-4 text-start duration-300">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="PlayStation" class="w-full h-40 object-cover rounded-md">
                        <h3 class="mt-4 text-base md:text-lg font-semibold">PS5 Standard</h3>
                        <p class="text-orange-600 font-semibold">Sewa Rp50.000/jam</p>
                        <button class="mt-4 w-full bg-gradient-to-l from-emerald-600 to-emerald-800 text-white py-2 rounded-lg hover:bg-emerald-700 hover:scale-105 focus:scale-95 duration-300">Sewa Sekarang</button>
                    </div>
                </div>
                <div  data-aos="fade-up" data-aos-duration="1500" class="">
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-2xl p-4 text-start duration-300">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="PlayStation" class="w-full h-40 object-cover rounded-md">
                        <h3 class="mt-4 text-base md:text-lg font-semibold">PS5 Standard</h3>
                        <p class="text-orange-600 font-semibold">Sewa Rp50.000/jam</p>
                        <button class="mt-4 w-full bg-gradient-to-l from-emerald-600 to-emerald-800 text-white py-2 rounded-lg hover:bg-emerald-700 hover:scale-105 focus:scale-95 duration-300">Sewa Sekarang</button>
                    </div>
                </div>
                <div  data-aos="fade-up" data-aos-duration="1500" class="">
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-2xl p-4 text-start duration-300">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="PlayStation" class="w-full h-40 object-cover rounded-md">
                        <h3 class="mt-4 text-base md:text-lg font-semibold">PS5 Standard</h3>
                        <p class="text-orange-600 font-semibold">Sewa Rp50.000/jam</p>
                        <button class="mt-4 w-full bg-gradient-to-l from-emerald-600 to-emerald-800 text-white py-2 rounded-lg hover:bg-emerald-700 hover:scale-105 focus:scale-95 duration-300">Sewa Sekarang</button>
                    </div>
                </div>
                <div  data-aos="fade-up" data-aos-duration="1500" class="">
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-2xl p-4 text-start duration-300">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="PlayStation" class="w-full h-40 object-cover rounded-md">
                        <h3 class="mt-4 text-base md:text-lg font-semibold">PS5 Standard</h3>
                        <p class="text-orange-600 font-semibold">Sewa Rp50.000/jam</p>
                        <button class="mt-4 w-full bg-gradient-to-l from-emerald-600 to-emerald-800 text-white py-2 rounded-lg hover:bg-emerald-700 hover:scale-105 focus:scale-95 duration-300">Sewa Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Persuassive Section --}}
    <section class="relative w-full h-full bg-fixed bg-center" 
        style="background-image: url('https://i.pinimg.com/736x/fc/43/90/fc4390ab742a1b9f148605e67b08ba36.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <div data-aos="fade-up" data-aos-duration="1000"  class="relative container mx-auto flex flex-col text-center justify-center items-center md:py-12 py-12 px-6 text-white">
            <h1 class="text-2xl font-bold">Lorem ipsum dolor sit amet.</h1>
            <p class="mt-4 text-lg">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deserunt, voluptatum?</p>
        </div>
    </section>

    {{-- Copyright Footer--}}
    <footer class="bg-emerald-700">
        <div class="max-w-6xl flex flex-col items-center justify-between p-6 mx-auto space-y-4 sm:space-y-0 sm:flex-row">
            <a href="#">
                {{-- <img class="w-auto h-7" src="https://merakiui.com/images/full-logo.svg" alt=""> --}}
                <h3 class="text-white font-semibold text-lg">GoodRent</h3>
            </a>
    
            <p class="text-white">&copy; Copyright 2025. All Rights Reserved.</p>
    
            <div class="flex space-x-4">
                <a href="">
                    <i class="fa-brands fa-whatsapp fa-xl text-white hover:-translate-y-1 hover:text-gray-200 duration-300"></i>
                </a>
                <a href="">
                    <i class="fa-brands fa-facebook fa-xl text-white hover:-translate-y-1 hover:text-gray-200 duration-300"></i>
                </a>
                <a href="">
                    <i class="fa-brands fa-instagram fa-xl text-white hover:-translate-y-1 hover:text-gray-200 duration-300"></i>
                </a>
            </div>
        </div>
    </footer>

    <!-- Include AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Initialize AOS -->
    <script>
        AOS.init();
    </script>
    
</body>

</html>


<script>
    // Toggle navbar membuka menu navbar mobile
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('menu-button');
        const dropdownMenu = document.getElementById('dropdown-menu');
        const menuIcon = document.getElementById('menu-open');
        const closeIcon = document.getElementById('menu-close');

        menuButton.addEventListener('click', function() {
            // Toggle dropdown menu dengan efek transisi
            if (dropdownMenu.classList.contains('hidden')) {
                dropdownMenu.classList.remove('hidden');
                setTimeout(() => {
                    dropdownMenu.classList.remove('opacity-0', 'scale-90');
                    dropdownMenu.classList.add('opacity-100', 'scale-100');
                }, 10); // Sedikit delay agar transisi bisa berjalan
            } else {
                dropdownMenu.classList.remove('opacity-100', 'scale-100');
                dropdownMenu.classList.add('opacity-0', 'scale-90');
                setTimeout(() => {
                    dropdownMenu.classList.add('hidden');
                }, 300); // Sembunyikan setelah transisi selesai
            }

            // Toggle ikon menu
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    });


    // transparansi navbar saat discroll
    window.addEventListener('scroll', function() { 
        const navbar = document.getElementById('navbar');
        const daftarButton = document.querySelector('a[href="/register"]');

        // Daftar menu berdasarkan ID
        const menuItems = {
            beranda: document.getElementById('menu-beranda'),
            tentang: document.getElementById('menu-tentang'),
            produk: document.getElementById('menu-produk'),
            contact: document.getElementById('menu-contact')
        };

        if (window.scrollY > 100) {
            navbar.classList.remove('bg-transparent');
            navbar.classList.add('bg-white');

            // Ubah warna menu
            for (let key in menuItems) {
                menuItems[key]?.classList.remove('text-white');
                menuItems[key]?.classList.add('text-emerald-600');
            }

            // Ubah border & teks button "Daftar" menjadi emerald
            daftarButton.classList.remove('border-white', 'text-white');
            daftarButton.classList.add('border-emerald-600', 'text-emerald-600');
        } else {
            navbar.classList.remove('bg-white');
            navbar.classList.add('bg-transparent');

            for (let key in menuItems) {
                menuItems[key]?.classList.remove('text-emerald-600');
                menuItems[key]?.classList.add('text-white');
            }

            // Kembalikan border & teks button "Daftar" ke warna putih
            daftarButton.classList.remove('border-emerald-600', 'text-emerald-600');
            daftarButton.classList.add('border-white', 'text-white');
        }
    });

</script>
