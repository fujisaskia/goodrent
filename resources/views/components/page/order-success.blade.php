<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Masuk Akun GoodRent</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo-fixed.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Font Awesome CDN Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex justify-center items-center min-h-screen bg-white px-6 text-sm md:text-xs">
    <div class="p-8 rounded-2xl text-center max-w-md">
        <img src="{{ asset('assets/success-order.png') }}" alt="Success" class="w-80 h-80 md:w-60 md:h-64 mx-auto mb-6">
        <h1 class="text-2xl font-bold text-green-600 mb-1">Yeay!</h1>
        <h1 class="text-2xl font-bold text-green-600 mb-4">Pesanan Kamu Berhasil 🎉</h1>

        <p class="text-gray-600 mb-6">Makasih udah order! Yuk ambil barang sewamu dan dateng ke alamat :
            <br>
            <br>
            <span class="font-semibold text-gray-800">SMK Negeri 1 Ciomas, Jl. Raya Laladon, Laladon, Kec. Ciomas,
                Kabupaten Bogor, Jawa Barat 16610</span>
        </p>
        <div class="flex justify-between gap-4">
            <a href="{{ route('lihat.produk') }}" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 rounded-lg transition focus:scale-95 duration-300">
                Balik ke Beranda
            </a>
            <a href="{{ route('user.riwayat.index') }}"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition focus:scale-95 duration-300">Lihat
                Pesanan</a>
        </div>
    </div>
</body>

</html>
