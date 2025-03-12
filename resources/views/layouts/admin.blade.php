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

    <!-- jQuery (Pastikan ini dimuat lebih dulu) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Toastr CSS -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}

        <!-- Laravel Notify -->
        @notifyCss

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-poppins bg-gradient-to-b from-emerald-50 to-slate-100 text-sm">

    <!-- Laravel Notify -->
    @include('notify::components.notify')
    @notifyJs
    

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
                            class="relative inline-flex items-center  text-sm font-medium text-center text-emerald-600 hover:scale-105 focus:scale-95 rounded-full duration-300 group">
                            <i class="fa-solid fa-bell text-3xl group-hover:rotate-6 duration-200"></i>
                            <span class="sr-only">Notifications</span>
                            <div
                                class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2">
                                10</div>
                        </button>
                    </div>
                    <!-- Modal Notification -->
                    <div id="notificationModal"
                        class="absolute right-0 mt-2 w-80 bg-white shadow-md border border-gray-300 rounded-lg hidden">
                        <!-- Header -->
                        <div class="flex justify-between items-center p-4 border-b">
                            <h3 class="text-base font-semibold">Notifikasi</h3>
                            {{-- <button onclick="closeNotification()" class="text-gray-500 hover:text-gray-700">&times;</button> --}}
                        </div>

                        <!-- Notification List (Scrollable) -->
                        <div class="max-h-64 overflow-y-auto">
                            <!-- Notification Item -->
                            <div class="flex items-start space-x-3 px-4 py-3 border-b hover:bg-gray-100">
                                <img src="{{ asset('assets/profile.jpg') }}" alt="Profile Picture"
                                    class="w-10 h-10 rounded-full">
                                <div>
                                    <p class="text-sm font-semibold">Admin</p>
                                    <p class="text-xs text-gray-600">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, repudiandae.</p>
                                    <span class="text-xs text-gray-400">10 menit yang lalu</span>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3 px-4 py-3 border-b hover:bg-gray-100">
                                <img src="{{ asset('assets/profile.jpg') }}" alt="Profile Picture"
                                    class="w-10 h-10 rounded-full">
                                <div>
                                    <p class="text-sm font-semibold">Sistem</p>
                                    <p class="text-xs text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                    <span class="text-xs text-gray-400">2 jam yang lalu</span>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3 px-4 py-3 border-b hover:bg-gray-100">
                                <img src="{{ asset('assets/profile.jpg') }}" alt="Profile Picture"
                                    class="w-10 h-10 rounded-full">
                                <div>
                                    <p class="text-sm font-semibold">Admin</p>
                                    <p class="text-xs text-gray-600">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    <span class="text-xs text-gray-400">1 hari yang lalu</span>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3 px-4 py-3 border-b hover:bg-gray-100">
                                <img src="{{ asset('assets/profile.jpg') }}" alt="Profile Picture"
                                    class="w-10 h-10 rounded-full">
                                <div>
                                    <p class="text-sm font-semibold">Sistem</p>
                                    <p class="text-xs text-gray-600">Lorem ipsum dolor sit amet.</p>
                                    <span class="text-xs text-gray-400">2 jam yang lalu</span>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3 px-4 py-3 border-b hover:bg-gray-100">
                                <img src="{{ asset('assets/profile.jpg') }}" alt="Profile Picture"
                                    class="w-10 h-10 rounded-full">
                                <div>
                                    <p class="text-sm font-semibold">Admin</p>
                                    <p class="text-xs text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, reprehenderit?</p>
                                    <span class="text-xs text-gray-400">1 hari yang lalu</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Profile Icon --}}
                <div class="relative">
                    <div class="flex items-center ml-auto space-x-2">
                        <button id="profileBtn" class="focus:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-10 h-10 rounded-full text-gray-400 hover:text-gray-500 border-gray-300">
                                <path fill-rule="evenodd"
                                    d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <!-- Dropdown Menu Profile -->
                    <div id="profileMenu"
                        class="absolute right-0 mt-2 w-56 bg-white shadow-md border border-gray-300 rounded-lg hidden">
                        <!-- Profil User -->
                        <div class="flex items-center space-x-2 p-4 border-b">
                            <img src="{{ asset('assets/profile.jpg') }}" alt="Profile Picture"
                                class="w-10 h-10 rounded-full">
                            <div>
                                <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <a href=""
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

                        <a href=""
                            class="flex w-full items-center space-x-3 px-4 py-2 text-gray-600 hover:bg-gray-100 my-1 group">
                            <i
                                class="fa-solid fa-gear text-base text-gray-400 border-gray-300 group-hover:rotate-90 duration-700"></i>
                            <span>Pengaturan</span>
                        </a>

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
    <div class="flex text-lg md:text-sm">
        <!-- Overlay -->
        <div id="sidebar-overlay"
            class="fixed inset-0 bg-black bg-opacity-50 hidden lg:hidden transition-opacity duration-300 z-10">
        </div>
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed top-20 left-0 lg:left-4 w-64 lg:w-56 h-5/6 bg-white py-4 px-3 lg:shadow-lg lg:shadow-emerald-100 shadow-none rounded-xl transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 z-10">

            <div class="space-y-2 py-8 items-center text-center bg-white rounded-lg">
                <span class="font-semibold text-2xl text-gray-800 font-playfair"><span class="text-emerald-800">-
                        GoodRent -</span>
            </div>


            <ul class="">
                <a href="/admin/dashboard">
                    <li
                        class="flex items-center space-x-3 font-medium py-3 rounded-r-xl px-4 mb-1 {{ Request::is('admin/dashboard') ? 'bg-gray-100 text-emerald-700 border-l-4 border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700 ' }} group">
                        <i class="fa-solid fa-chart-line text-base"></i> <!-- Statistik/Grafik -->
                        <p class="group-hover:translate-x-1 duration-500">Dashboard</p>
                    </li>
                </a>

                <a href="/admin/data-barang">
                    <li
                        class="flex items-center space-x-3 font-medium py-3 rounded-r-xl px-4 mb-1 {{ Request::is('admin/data-barang') ? 'bg-gray-100 text-emerald-700 border-l-4 border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700 ' }} group">
                        <i class="fa-solid fa-box-open text-base"></i>
                        <p class="group-hover:translate-x-1 duration-500">Data Barang</p>
                    </li>
                </a>

                <a href="/admin/data-sewa">
                    <li
                        class="flex items-center space-x-3 font-medium py-3 rounded-r-xl px-4 mb-1 {{ Request::is('admin/data-sewa') ? 'bg-gray-100 text-emerald-700 border-l-4 border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700 ' }} group">
                        <i class="fa-solid fa-bag-shopping text-base mr-1.5"></i>
                        <p class="group-hover:translate-x-1 duration-500">Data Sewa</p>
                    </li>
                </a>

                <a href="/admin/kelola-pelanggan">
                    <li
                        class="flex items-center space-x-3 font-medium py-3 rounded-r-xl px-4 mb-1 {{ Request::is('admin/kelola-pelanggan') ? 'bg-gray-100 text-emerald-700 border-l-4 border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700 ' }} group">
                        <x-iconsax-bol-profile-2user class="w-5 h-auto" />
                        <p class="group-hover:translate-x-1 duration-500">Kelola Pelanggan</p>
                    </li>
                </a>

                <a href="/admin/kelola-diskon">
                    <li
                        class="flex items-center space-x-3 font-medium py-3 rounded-r-xl px-4 mb-1 {{ Request::is('admin/kelola-diskon') ? 'bg-gray-100 text-emerald-700 border-l-4 border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700 ' }} group">
                        <i class="fa-solid fa-percent text-base mr-1.5"></i>
                        <p class="group-hover:translate-x-1 duration-500">Kelola Diskon</p>
                    </li>
                </a>

                <a href="/admin/laporan-goodrent">
                    <li
                        class="flex items-center space-x-3 font-medium py-3 rounded-r-xl px-4 mb-1 {{ Request::is('admin/laporan-goodrent') ? 'bg-gray-100 text-emerald-700 border-l-4 border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700 ' }} group">
                        <i class="fa-solid fa-folder-open text-base"></i>
                        <p class="group-hover:translate-x-1 duration-500">Laporan</p>
                    </li>
                </a>

                <form action="{{ route('logout') }}" method="POST"
                    class="flex justify-center items-center text-xs">
                    @csrf
                    <button type="submit"
                        class="flex fixed bottom-5 justify-center items-center border-2 border-gray-300 space-x-3 font-medium py-1 rounded-full px-6 mb-1 hover:bg-red-100 duration-300">
                        <i class="fa-solid fa-arrow-right-from-bracket text-base"></i>
                        <p class="">Keluar</p>
                    </button>
                </form>

            </ul>

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

    // animate loading & notification ketika halaman dimuat
    window.addEventListener("load", function() {
        setTimeout(function() {
            document.getElementById("loading-spinner").classList.add("hidden");

            // Tampilkan Toastr setelah animasi loading selesai
            setTimeout(function() {
                @if (session('success'))
                    toastr.success("{{ session('success') }}");
                @elseif (session('error'))
                    toastr.error("{{ session('error') }}");
                @elseif (session('info'))
                    toastr.info("{{ session('info') }}");
                @elseif (session('warning'))
                    toastr.warning("{{ session('warning') }}");
                @endif
            }, 500); // Toastr muncul 0.5 detik setelah spinner hilang
        }, 1000); // Spinner hilang setelah 1 detik
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
