<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Default Title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo-fixed.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- jQuery (Pastikan ini dimuat lebih dulu) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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



    <!-- Toastr CSS -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-poppins bg-gradient-to-b from-emerald-50 to-slate-100 text-base md:text-xs">
    <!-- Navbar -->
    <nav
        class="fixed top-0 left-0 right-0 bg-white shadow-md p-3 rounded-lg m-2 border border-gray-300 md:border-none z-20">
        <div class="flex max-w-6xl justify-between items-center lg:ml-56">
            <div class="items-center space-x-4">
                <!-- Button membuka sidebar -->
                <button id="button-open-sidebar"
                    class="flex lg:hidden rounded-lg p-1 text-slate-900 ml-3 lg:ml-0 active:bg-white focus:outline-none focus:ring focus:ring-emerald-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                    </svg>
                </button>
                <!-- Button menutup sidebar -->
                <button id="button-close-sidebar" class="hidden lg:hidden transition-all duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8 text-emerald-600 hover:text-emerald-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Notification & Profile Icon-->
            <div class="flex relative items-center space-x-3">
                {{-- Notification Icon --}}
                <div class="relative">
                    <div class="items-center">
                        <button type="button" id="notificationBtn"
                            class="relative inline-flex items-center text-sm font-medium text-center text-emerald-600 hover:scale-105 focus:scale-95 rounded-full duration-300 group">
                            <i class="fa-solid fa-bell text-3xl group-hover:rotate-6 duration-200"></i>
                            <span class="sr-only">Notifications</span>
                            <div
                                class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2">
                                {{ $jumlahNotifikasi }}
                            </div>
                        </button>
                    </div>
                    <!-- Modal Notification -->
                    <div id="notificationModal"
                        class="absolute right-0 mt-2 w-80 bg-white shadow-md border border-gray-300 rounded-lg hidden">
                        <!-- Header -->
                        <div class="flex justify-between items-center p-4 border-b">
                            <h3 class="text-base font-semibold">Notifikasi</h3>
                        </div>

                        <!-- Notification List (Scrollable) -->
                        <div class="max-h-64 overflow-y-auto">
                            @forelse ($notifikasi as $notif)
                                <div class="flex items-start space-x-3 px-4 py-3 border-b hover:bg-gray-100">
                                    <img src="{{ asset('storage/users/' . (Auth::user()->image ?: 'Dummy.png')) }}"
                                        alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-full object-cover">
                                    <div>
                                        <p class="text-sm font-semibold">{{ $notif->user?->name ?? '-' }}</p>
                                        <div>
                                            @foreach ($notif->items as $item)
                                                @php
                                                    $barang = $item->barang;
                                                @endphp
                                                <p class="text-xs text-gray-600">
                                                    Telah memesan
                                                    <span class="font-semibold">
                                                        {{ $barang?->nama_barang ?? '-' }}
                                                    </span><br>

                                                    Tanggal Sewa:
                                                    @if ($item->tanggal_mulai && $item->tanggal_selesai)
                                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F, Y') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F, Y') }}
                                                    @else
                                                        <span class="text-red-500">Tanggal tidak lengkap</span>
                                                    @endif
                                                </p>

                                                <p class="font-semibold mt-1">
                                                    Durasi:
                                                    @if (isset($item->durasi_sewa))
                                                        @if ($item->durasi_sewa >= 24)
                                                            {{ floor($item->durasi_sewa / 24) }} Hari
                                                        @else
                                                            {{ $item->durasi_sewa }} Jam
                                                        @endif
                                                    @else
                                                        <span class="text-gray-500">-</span>
                                                    @endif
                                                </p>

                                                <p>Harga:
                                                    Rp{{ number_format($item->harga_barang, 0, ',', '.') }}
                                                </p>
                                            @endforeach
                                        </div>

                                        Status Pembayaran:
                                        <span
                                            class="font-semibold 
                                                @if ($notif->pembayaran?->status_pembayaran === 'Berhasil') text-green-600
                                                @elseif($notif->pembayaran?->status_pembayaran === 'Gagal')
                                                    text-red-600
                                                @else
                                                    text-yellow-600 @endif">
                                            {{ $notif->pembayaran?->status_pembayaran ?? '-' }}
                                        </span><br>

                                        <span class="text-xs text-gray-400">
                                            {{ $notif->created_at?->diffForHumans() ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="px-4 py-3 text-center text-sm text-gray-500">Tidak ada notifikasi baru.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Profile Icon --}}
                <div class="relative">
                    <div class="flex items-center ml-auto space-x-2">
                        <button id="profileBtn" class="focus:scale-95">
                            <img src="{{ asset('storage/users/' . (Auth::user()->image ?: 'Dummy.png')) }}"
                                alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-full object-cover">
                        </button>
                    </div>
                    <!-- Dropdown Menu Profile -->
                    <div id="profileMenu"
                        class="absolute right-0 mt-2 w-56 bg-white shadow-md border border-gray-300 rounded-lg hidden">
                        <!-- Profil User -->
                        <div class="flex items-center space-x-2 p-4 border-b">
                            <img src="{{ asset('storage/users/' . (Auth::user()->image ?: 'Dummy.png')) }}"
                                alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <a href="{{ route('admin.profile') }}"
                            class="flex w-full items-center space-x-3 px-3 py-2 text-gray-600 hover:bg-gray-100 my-1 group">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6 rounded-full text-gray-400 border-gray-300">
                                <path fill-rule="evenodd"
                                    d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{-- <i class="fa-solid fa-user text-base text-gray-400 border-gray-300 px-1.5 py-0.5 group-hover:bg-gray-400 group-hover:text-white rounded-full duration-700"></i> --}}
                            <span>Profil</span>
                        </a>

                        {{-- <a href=""
                            class="flex w-full items-center space-x-3 px-4 py-2 text-gray-600 hover:bg-gray-100 my-1 group">
                            <i
                                class="fa-solid fa-gear text-base text-gray-400 border-gray-300 group-hover:rotate-90 duration-700"></i>
                            <span>Pengaturan</span>
                        </a> --}}

                        <!-- Logout Form -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex w-full items-center space-x-3 px-4 py-2 text-red-600 hover:bg-red-100 my-3">
                                <i class="fa-solid fa-arrow-right-from-bracket text-base"></i>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- Sidebar --}}
    <div class="flex">
        <!-- Overlay -->
        <div id="sidebar-overlay"
            class="fixed inset-0 bg-black bg-opacity-50 hidden lg:hidden transition-opacity duration-300 z-10">
        </div>
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed top-20 left-0 lg:left-4 w-64 lg:w-56 h-5/6 bg-white py-4 px-3 lg:shadow-lg lg:shadow-emerald-100 shadow-none rounded-xl transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 z-10">

            <div class="space-y-2 my-4 items-center justify-center text-center bg-white rounded-lg">
                {{-- <span class="font-semibold text-2xl text-gray-800 font-playfair"><span class="text-emerald-800">-
                        GoodRent -</span> --}}
                <img src="{{ asset('assets/logo-fixed.png') }}" alt=""
                    class="w-20 h-20 items-center justify-center mx-auto">
            </div>


            <ul class="">
                <a href="/admin/dashboard">
                    <li
                        class="flex items-center space-x-3 font-medium py-3 md:py-2.5 rounded-r-xl px-4 mb-1 {{ Request::is('admin/dashboard') ? 'bg-gray-100 text-emerald-700 border-l-4 border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700 ' }} group">
                        <i class="fa-solid fa-chart-line text-base"></i> <!-- Statistik/Grafik -->
                        <p class="group-hover:translate-x-1 duration-500">Dashboard</p>
                    </li>
                </a>

                @php
                    $isBarangActive = Request::is('admin/data-barang*') || Request::is('admin/kategori-barang*');
                @endphp

                <li class="relative">
                    <button onclick="toggleSubmenu('barang')"
                        class="w-full text-left flex items-center justify-between font-medium py-3 md:py-2.5 rounded-r-xl px-4 mb-1 hover:bg-slate-100 {{ $isBarangActive ? 'text-gray-700' : 'text-gray-600 hover:text-gray-700' }}">
                        <div class="flex items-center space-x-3">
                            <i class="fa-solid fa-box-open text-base"></i>
                            <p class="group-hover:translate-x-1 duration-500">Kelola Barang</p>
                        </div>
                        <i id="arrow-icon-barang"
                            class="fa-solid {{ $isBarangActive ? 'fa-chevron-up' : 'fa-chevron-down' }} text-sm"></i>
                    </button>

                    <ul id="sub-menu-barang"
                        class="ml-6 mt-1 overflow-hidden transition-all duration-300 ease-in-out {{ $isBarangActive ? 'max-h-[200px]' : 'max-h-0' }}">
                        <li
                            class="{{ Request::is('admin/data-barang') ? 'bg-gray-100 text-emerald-700 border-l-4 rounded-r border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700' }}">
                            <a href="/admin/data-barang" class="flex items-center space-x-2 p-2">
                                <i class="fa-solid fa-database text-sm"></i>
                                <span>Data Barang</span>
                            </a>
                        </li>
                        <li
                            class="mt-1 {{ Request::is('admin/kategori-barang') ? 'bg-gray-100 text-emerald-700 border-l-4 rounded-r border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700' }}">
                            <a href="/admin/kategori-barang" class="flex items-center space-x-2 p-2">
                                <i class="fa-solid fa-tags text-sm"></i>
                                <span>Kategori Barang</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <a href="/admin/data-sewa">
                    <li
                        class="flex items-center space-x-3 font-medium py-3 md:py-2.5 rounded-r-xl px-4 mb-1 {{ Request::is('admin/data-sewa') ? 'bg-gray-100 text-emerald-700 border-l-4 border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700 ' }} group">
                        <i class="fa-solid fa-bag-shopping text-base mr-1.5"></i>
                        <p class="group-hover:translate-x-1 duration-500">Data Sewa</p>
                    </li>
                </a>

                <a href="/admin/kelola-pelanggan">
                    <li
                        class="flex items-center space-x-3 font-medium py-3 md:py-2.5 rounded-r-xl px-4 mb-1 {{ Request::is('admin/kelola-pelanggan') ? 'bg-gray-100 text-emerald-700 border-l-4 border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700 ' }} group">
                        <x-iconsax-bol-profile-2user class="w-5 h-auto" />
                        <p class="group-hover:translate-x-1 duration-500">Kelola Pelanggan</p>
                    </li>
                </a>

                @php
                    $isDiskonActive = Request::is('admin/kelola-diskon') || Request::is('admin/kategori-diskon');
                @endphp

                <li class="relative">
                    <button onclick="toggleSubmenu('diskon')"
                        class="w-full text-left flex items-center justify-between font-medium py-3 md:py-2.5 rounded-r-xl px-4 mb-1 hover:bg-slate-100 {{ $isDiskonActive ? 'text-gray-700' : 'text-gray-600 hover:text-gray-700' }}">
                        <div class="flex items-center space-x-3">
                            <i class="fa-solid fa-percent text-base mr-1.5"></i>
                            <p class="group-hover:translate-x-1 duration-500">Kelola Diskon</p>
                        </div>
                        <i id="arrow-icon-diskon"
                            class="fa-solid {{ $isDiskonActive ? 'fa-chevron-up' : 'fa-chevron-down' }} text-sm"></i>
                    </button>

                    <ul id="sub-menu-diskon"
                        class="ml-6 mt-1 overflow-hidden transition-all duration-300 ease-in-out {{ $isDiskonActive ? 'max-h-[200px]' : 'max-h-0' }}">
                        <li
                            class="{{ Request::is('admin/kelola-diskon*') ? 'bg-gray-100 text-emerald-700 border-l-4 rounded-r border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700' }}">
                            <a href="/admin/kelola-diskon" class="flex items-center space-x-2 p-2">
                                <i class="fa-solid fa-database text-sm"></i>
                                <span>Data Diskon</span>
                            </a>
                        </li>
                        <li
                            class="mt-1 {{ Request::is('admin/kategori-diskon') ? 'bg-gray-100 text-emerald-700 border-l-4 rounded-r border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700' }}">
                            <a href="/admin/kategori-diskon" class="flex items-center space-x-2 p-2">
                                <i class="fa-solid fa-tags text-sm"></i>
                                <span>Kategori Diskon</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <a href="/admin/laporan-goodrent">
                    <li
                        class="flex items-center space-x-3 font-medium py-3 md:py-2.5 rounded-r-xl px-4 mb-1 {{ Request::is('admin/laporan-goodrent') ? 'bg-gray-100 text-emerald-700 border-l-4 border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700 ' }} group">
                        <i class="fa-solid fa-folder-open text-base"></i>
                        <p class="group-hover:translate-x-1 duration-500">Laporan</p>
                    </li>
                </a>

                {{-- <form action="{{ route('logout') }}" method="POST"
                    class="flex justify-center items-center">
                    @csrf
                    <button type="submit"
                        class="flex text-gray-600 hover:text-gray-800 fixed bottom-5 justify-center items-center border border-gray-300 space-x-3 font-medium py-1 rounded-full px-6 mb-1 hover:bg-red-100 duration-300">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <p class="">Keluar</p>
                    </button>
                </form> --}}

            </ul>

        </aside>
    </div>

    {{-- content here --}}
    <div class="min-h-screen py-24 mx-4 lg:mx-8">
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

    <!-- Toastr JS (Harus setelah jQuery) -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}


</body>

</html>

<script>
    const menuButton = document.getElementById("button-open-sidebar");
    const closeButton = document.getElementById("button-close-sidebar");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("sidebar-overlay");

    const profileBtn = document.getElementById('profileBtn');
    const profileMenu = document.getElementById('profileMenu');

    const notificationBtn = document.getElementById('notificationBtn');
    const notificationModal = document.getElementById('notificationModal');

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
                        timerProgressBar: true
                    });
                @elseif (session('error'))
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "error",
                        title: "{{ session('error') }}",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                @elseif (session('info'))
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "info",
                        title: "{{ session('info') }}",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                @elseif (session('warning'))
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "warning",
                        title: "{{ session('warning') }}",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                @endif
            }, 500); // Muncul 0.5 detik setelah loading selesai
        }, 1000); // Loading hilang setelah 1 detik
    });

    // Membuka Menu Sidebar ketika mobile dan tab
    menuButton.addEventListener("click", () => {
        sidebar.classList.remove("-translate-x-full");
        menuButton.classList.add("hidden");
        closeButton.classList.remove("hidden");
        overlay.classList.remove("hidden");
        overlay.classList.add("opacity-100");
        document.body.classList.add("overflow-hidden"); // Cegah scrolling
    });

    // Menutup Menu Sidebar ketika mobile dan tab
    closeButton.addEventListener("click", () => {
        sidebar.classList.add("-translate-x-full");
        menuButton.classList.remove("hidden");
        closeButton.classList.add("hidden");
        overlay.classList.add("hidden");
        overlay.classList.remove("opacity-100");
        document.body.classList.remove("overflow-hidden"); // Cegah scrolling
    });

    // Klik overlay bg-hitam ketika membuka sidebar
    overlay.addEventListener("click", () => {
        sidebar.classList.add("-translate-x-full");
        menuButton.classList.remove("hidden");
        closeButton.classList.add("hidden");
        overlay.classList.add("hidden");
        overlay.classList.remove("opacity-100");
        document.body.classList.remove("overflow-hidden"); // Cegah scrolling
    });


    //Toggle Menu Kelola : Barang dan Diskon
    function toggleSubmenu(type) {
        const allMenus = ['barang', 'diskon']; // tambahkan id dropdown lain di sini
        allMenus.forEach(menu => {
            const submenu = document.getElementById(`sub-menu-${menu}`);
            const arrow = document.getElementById(`arrow-icon-${menu}`);

            if (menu === type) {
                const isOpen = submenu.classList.contains('max-h-[200px]');
                if (isOpen) {
                    submenu.classList.remove('max-h-[200px]');
                    submenu.classList.add('max-h-0');
                    arrow.classList.remove('fa-chevron-up');
                    arrow.classList.add('fa-chevron-down');
                } else {
                    submenu.classList.remove('max-h-0');
                    submenu.classList.add('max-h-[200px]');
                    arrow.classList.remove('fa-chevron-down');
                    arrow.classList.add('fa-chevron-up');
                }
            } else {
                // Tutup semua selain yang diklik
                submenu.classList.remove('max-h-[200px]');
                submenu.classList.add('max-h-0');
                arrow.classList.remove('fa-chevron-up');
                arrow.classList.add('fa-chevron-down');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        @if ($isBarangActive)
            const submenuBarang = document.getElementById('sub-menu-barang');
            const arrowBarang = document.getElementById('arrow-icon-barang');
            submenuBarang.classList.remove('max-h-0');
            submenuBarang.classList.add('max-h-[200px]');
            arrowBarang.classList.remove('fa-chevron-down');
            arrowBarang.classList.add('fa-chevron-up');
        @endif

        @if ($isDiskonActive)
            const submenuDiskon = document.getElementById('sub-menu-diskon');
            const arrowDiskon = document.getElementById('arrow-icon-diskon');
            submenuDiskon.classList.remove('max-h-0');
            submenuDiskon.classList.add('max-h-[200px]');
            arrowDiskon.classList.remove('fa-chevron-down');
            arrowDiskon.classList.add('fa-chevron-up');
        @endif
    });


    // Button membuka Menu Profile
    profileBtn.addEventListener('click', () => {
        profileMenu.classList.toggle('hidden');
    });

    // Klik di luar menu untuk menutup dropdown Menu Profile
    document.addEventListener('click', (event) => {
        if (!profileBtn.contains(event.target) && !profileMenu.contains(event.target)) {
            profileMenu.classList.add('hidden');
        }
    });

    // Button Membuka Notification Modal
    notificationBtn.addEventListener('click', () => {
        notificationModal.classList.toggle('hidden');
    });

    // Klik di luar menu untuk menutup modal Notikasi
    document.addEventListener('click', (event) => {
        if (!notificationBtn.contains(event.target) && !notificationModal.contains(event.target)) {
            notificationModal.classList.add('hidden');
        }
    });

    // fungsi menutup modal
    // function closeNotification() {
    //     document.getElementById('notificationModal').classList.add('hidden');
    // }
</script>
