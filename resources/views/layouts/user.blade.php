<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Default Title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Data AOS Animate --}}
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Font Awesome CDN Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- chart js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Calendar Format --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script> <!-- Lokal Bahasa Indonesia -->

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-poppins bg-slate-100 text-sm">

    <!-- Navbar -->
    @include('components.navbar-user')

    {{-- Sidebar --}}
    <div class="flex text-lg md:text-sm">
        <!-- Overlay -->
        <div id="sidebar-overlay"
            class="fixed inset-0 bg-black bg-opacity-50 hidden lg:hidden transition-opacity duration-300 z-10">
        </div>
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed top-24 left-0 lg:left-4 w-64 lg:w-60 h-4/5 bg-white py-4 px-3 lg:shadow-lg lg:shadow-emerald-100 shadow-none rounded-xl transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 z-10">

            <div class="space-y-2 py-8 items-center text-center bg-white rounded-lg">
                <span class="font-semibold text-2xl text-gray-800 font-playfair"><span class="text-emerald-800">-
                        GoodRent -</span>
            </div>


            <div class="flex flex-col space-y-3">
                <a href="/goodrent/profile">
                    <li
                        class="flex items-center space-x-3 font-medium py-2 rounded-r-xl px-4 {{ Request::is('profile') ? 'bg-gray-100 text-emerald-700 border-l-4 border-gray-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700 ' }} group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <p class="group-hover:translate-x-1 duration-500">Profile</p>
                    </li>
                </a>

                <a href="/goodrent/riwayat/pemesanan-saya">
                    <li
                        class="flex items-center space-x-3 font-medium py-2 rounded-r-xl px-4 {{ Request::is('goodrent/riwayat/pemesanan-saya') ? 'bg-gray-100 text-emerald-700 border-l-4 border-gray-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700 ' }} group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <p class="group-hover:translate-x-1 duration-500">Pemesanan</p>
                    </li>
                </a>
                
                
                {{-- <a href="/goodrent/profile/alamat">
                    <li
                        class="flex items-center space-x-3 font-medium py-2 rounded-r-xl px-4 {{ Request::is('') ? 'bg-gray-100 text-emerald-700 border-l-4 border-gray-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700 ' }} group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        
                        <p class="group-hover:translate-x-1 duration-500">Alamat</p>
                    </li>
                </a> --}}

                    <div class="w-2/3 text-center justify-center mx-auto h-px bg-gray-200 my-4"></div>

                    <a href="{{ route('lihat.produk') }}"
                        class="flex w-full bg-gray-50 hover:bg-gray-200 text-emerald-900 hover:text-emerald-800 items-center space-x-3 font-medium py-2 rounded-xl px-4 mt-1 duration-300">
                        <i class="fa-solid fa-arrow-left"></i>
                        <p class="">Kembali ke beranda</p>
                    </a>

            </div>

        </aside>
    </div>

    {{-- content here --}}
    <div class="min-h-screen py-24 mx-4 lg:mx-8 ">
        <!-- Main Content -->
        <main class="flex-1 lg:ml-60 mb-8">
            @yield('content')
        </main>
    </div>

    {{-- animate loading tap --}}
    <div id="loading-spinner" class="fixed inset-0 flex items-center justify-center bg-white block z-50">
        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
        <dotlottie-player src="https://lottie.host/a9373d02-c947-48ca-8476-b2452dd2b17b/4nxgGAFhrG.lottie"
            background="transparent" speed="1" style="width: 100px; height: 100px" loop
            autoplay></dotlottie-player>
    </div>

</body>

</html>

<script>
    // Animate loading & notification ketika halaman dimuat
    window.addEventListener("load", function() {
        setTimeout(function() {
            document.getElementById("loading-spinner").classList.add("hidden");

            // Tampilkan SweetAlert Toast setelah animasi loading selesai
            setTimeout(function() {
                @if (session('success'))
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        title: "{{ session('success') }}",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: false
                    });
                @elseif (session('error'))
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "error",
                        title: "{{ session('error') }}",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: false
                    });
                @elseif (session('info'))
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "info",
                        title: "{{ session('info') }}",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: false
                    });
                @elseif (session('warning'))
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "warning",
                        title: "{{ session('warning') }}",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: false
                    });
                @endif
            }, 500); // Muncul 0.5 detik setelah loading selesai
        }, 1000); // Loading hilang setelah 1 detik
    });
</script>
