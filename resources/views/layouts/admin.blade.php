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

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-poppins bg-gradient-to-b from-emerald-50 to-slate-50 text-sm">

    <div id="loading" class="fixed inset-0 flex items-center justify-center bg-white z-50">
        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-emerald-600"></div>
    </div>
    

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 bg-white shadow-sm p-3">
        <div class="flex max-w-6xl justify-between items-center lg:ml-56">
            <div class="items-center space-x-4">
                <!-- Button membuka sidebar -->
                <button id="button-open-sidebar" class="flex lg:hidden rounded-lg p-1 text-slate-900 ml-3 lg:ml-0 active:bg-white focus:outline-none focus:ring focus:ring-emerald-300">
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

            <!-- Profile Icon with Dropdown using Alpine.js -->
            <div class="relative">
                <a class="flex items-center ml-auto space-x-2">
                    <p class="text-base">Admin</p>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-10 h-10 rounded-full text-gray-400 border-gray-300">
                        <path fill-rule="evenodd"
                            d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    {{-- Sidebar --}}
    <div class="flex text-base md:text-sm">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed top-20 left-0 lg:left-4 w-64 lg:w-56 h-4/5 bg-white py-4 px-3 shadow-lg hover:shadow-emerald-100 rounded-xl transform  -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0">

            <div class="space-y-2 py-8 items-center text-center bg-white rounded-lg">
                <span class="font-semibold text-2xl text-gray-800 font-playfair"><span class="text-emerald-800">- GoodRent -</span>
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

                <a href="/admin/kelola-user">
                    <li
                        class="flex items-center space-x-3 font-medium py-3 rounded-r-xl px-4 mb-1 {{ Request::is('admin/kelola-user') ? 'bg-gray-100 text-emerald-700 border-l-4 border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700 ' }} group">
                        <x-iconsax-bol-profile-2user class="w-5 h-auto" />
                        <p class="group-hover:translate-x-1 duration-500">Kelola User</p>
                    </li>
                </a>

                <a href="/admin/kelola-diskon">
                    <li
                        class="flex items-center space-x-3 font-medium py-3 rounded-r-xl px-4 mb-1 {{ Request::is('admin/kelola-diskon') ? 'bg-gray-100 text-emerald-700 border-l-4 border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700 ' }} group">
                        <i class="fa-solid fa-percent text-base mr-1.5"></i>
                        <p class="group-hover:translate-x-1 duration-500">Kelola Diskon</p>
                    </li>
                </a>

                <a href="">
                    <li
                        class="flex items-center space-x-3 font-medium py-3 rounded-r-xl px-4 mb-1 {{ Request::is('') ? 'bg-gray-100 text-emerald-700 border-l-4 border-emerald-600 hover:bg-gray-200 font-semibold' : 'hover:bg-slate-100 text-gray-600 hover:text-gray-700 ' }} group">
                        <i class="fa-solid fa-folder-open text-base"></i>
                        <p class="group-hover:translate-x-1 duration-500">Laporan</p>
                    </li>
                </a>

                <a href="" class="flex justify-center items-center">
                    <li
                        class="flex fixed bottom-5 justify-center items-center border-2 border-red-500 space-x-3 font-medium py-2 rounded-full px-6 mb-1 hover:bg-red-100 duration-300">
                        <i class="fa-solid fa-arrow-right-from-bracket text-base"></i>
                        <p class="">Keluar</p>
                    </li>
                </a>

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



</body>

</html>

<script>
    window.addEventListener("load", function () {
        document.getElementById("loading").style.display = "none";
    });
    
    const menuButton = document.getElementById("button-open-sidebar");
    const closeButton = document.getElementById("button-close-sidebar");
    const sidebar = document.getElementById("sidebar");

    menuButton.addEventListener("click", () => {
        sidebar.classList.remove("-translate-x-full");
        menuButton.classList.add("hidden");
        closeButton.classList.remove("hidden");
    });

    closeButton.addEventListener("click", () => {
        sidebar.classList.add("-translate-x-full");
        menuButton.classList.remove("hidden");
        closeButton.classList.add("hidden");
    });
</script>
