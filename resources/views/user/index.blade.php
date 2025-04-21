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

    {{-- sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Font Awesome CDN Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css'])

</head>
{{-- bg-gradient-to-b from-emerald-100 to-slate-200 --}}

<body class="bg-white pt-20">

    {{-- Navbar  --}}
    @include('components.navbar-user')

    <!-- Banner -->
    <div class="max-w-6xl mx-auto">
        <div
            class="flex flex-col md:flex-row m-4 p-6 h-80 md:h-64 bg-gradient-to-r from-cyan-500 to-cyan-200 rounded-lg justify-between items-center shadow-xl relative overflow-hidden">
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-700/20 to-emerald-500/10"></div>

            <!-- Pattern -->
            <div class="absolute inset-0 bg-repeat opacity-20"
                style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9IiMwMDAwMDAiLz48ZyBvcGFjaXR5PSIwLjEiPjxjaXJjbGUgY3g9IjEwIiBjeT0iMTAiIHI9IjEwIiBmaWxsPSIjZmZmIi8+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMTAiIGZpbGw9IiNmZmYiLz48Y2lyY2xlIGN4PSI1MCIgY3k9IjUwIiByPSIxMCIgZmlsbD0iI2ZmZiIvPjwvZz48L3N2Zz4=');">
            </div>

            <!-- Content -->
            <div class="flex-1 text-center md:text-left z-10">
                <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg">Selamat Datang,
                    {{ Auth::user()->name }}👋</h1>
                <q class="text-gray-100 max-w-md text-lg italic">
                    Siap main tanpa batas? Sewa PS & barang favoritmu sekarang!
                </q>
            </div>

            <!-- Ilustrasi Dashboard -->
            <div class="flex z-10">
                <img src="{{ asset('assets/play.png') }}" alt="Illustration Dashboard"
                    class="animate-smallbounce w-80 drop-shadow-lg hover:drop-shadow-xl transition-all duration-300">
            </div>

            <!-- Glow Effect -->
            <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-yellow-300 rounded-full opacity-20 blur-2xl"></div>
            <div class="absolute -top-20 -left-20 w-64 h-64 bg-yellow-300 rounded-full opacity-20 blur-2xl"></div>
        </div>
    </div>


    <!-- Search Bar -->
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-center items-center space-x-3 my-8 mx-4">
            <input type="search" placeholder="Cari Produk yang dibutuhkan..."
                class="w-2/3 px-4 py-3 border md:border-gray-300 border-gray-400 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-emerald-200">
            <button class="py-3 px-4 bg-emerald-600 rounded-full shadow-xl text-white focus:scale-95 duration-300">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </div>

    <!-- Produk -->
    <section class="pb-8">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-xl lg:text-2xl font-bold m-4 text-gray-700">Rekomendasi PS khusus buat kamu</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-6 gap-3 mx-5 text-sm">
                @foreach ($barangs as $barang)
                            @php
                                $isTersedia = $barang->status_barang !== 'Tidak Tersedia';
                            @endphp
                    <div class="{{ $isTersedia ? 'bg-white shadow-md hover:shadow-2xl' : 'bg-gray-100 cursor-not-allowed shadow-sm' }} rounded  hover:shadow-emerald-200 duration-300">
                        <img src="{{ asset('storage/barangs/' . $barang->image) }}" alt="{{ $barang->nama_barang }}"
                            class="w-full rounded-t h-32 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium">{{ $barang->nama_barang }}</h3>
                            @php
                                $harga24jam = $barang->hargaSewas->where('durasi_jam', 24)->first();
                            @endphp


                            <p class="font-bold text-base">Rp {{ number_format($harga24jam?->harga ?? 0, 0, ',', '.') }} <span class="text-xs text-gray-700">/1 hari</span></p>
                            <p class="text-xs text-gray-700">
                                Tersedia : {{ $barang->stok == 0 ? 'Habis' : $barang->stok }}
                            </p>                                                       
                            
                            <a href="{{ $isTersedia ? route('produk.detail', $barang->id) : '#' }}"
                                class="{{ $isTersedia ? 'bg-emerald-500 hover:bg-emerald-600' : 'bg-gray-400 cursor-not-allowed' }} text-white py-1.5 rounded-md block mt-5">
                                <button class="w-full font-semibold group-focus:scale-95 duration-300 text-xs"
                                    {{ $isTersedia ? '' : 'disabled' }}>
                                    Pilih
                                </button>
                            </a>
                        
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer-user')

    {{-- animate loading tap --}}
    <div id="loading-spinner" class="fixed inset-0 flex items-center justify-center bg-white block z-50">
        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
        <dotlottie-player src="https://lottie.host/a9373d02-c947-48ca-8476-b2452dd2b17b/4nxgGAFhrG.lottie"
            background="transparent" speed="1" style="width: 100px; height: 100px" loop
            autoplay></dotlottie-player>
    </div>

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
