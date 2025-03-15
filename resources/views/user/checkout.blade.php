<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CheckOut</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome CDN Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css'])

</head>
{{-- bg-gradient-to-b from-emerald-100 to-slate-200 --}}

<body class=" bg-gradient-to-b from-emerald-50 to-slate-200 pt-20">

    {{-- Navbar --}}
    @include('components.navbar-user')


    {{-- Konten di Sini --}}
    <div class="max-w-5xl mx-auto py-8 h-screen mb-10 md:mb-24">
        <div class="bg-white border p-6 rounded-lg shadow-lg mx-4">
            {{-- Info USer --}}
            <div class="mb-5">
                <h2 class="text-gray-700 text-2xl font-semibold text-center md:text-start mb-2 md:mb-0">CheckOut</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border border-gray-200 rounded-md p-4 mb-6">
                <div class="space-y-4">
                    <div class="flex flex-col space-y-1">
                        <h5 class="text-gray-700 text-xs">Nama :</h5>
                        <h3 class="">Fuji Saskia</h3>
                    </div>

                    <div class="flex flex-col space-y-1">
                        <h5 class="text-gray-700 text-xs">No Telepon :</h5>
                        <h3 class="">089211223344</h3>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex flex-col space-y-1">
                        <h5 class="text-gray-700 text-xs">Alamat :</h5>
                        <h3 class="text-sm pr-8">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos nihil alias doloribus.</h3>
                    </div>

                    <div class="">
                        <h5 class="text-sm font-semibold text-yellow-500">Ubah Alamat</h5>
                    </div>
                </div>
            </div>

            {{-- Detail Pemesanan --}}
            <div class="mb-5">
                <h2 class="text-gray-700 text-2xl font-semibold text-center md:text-start mb-2 md:mb-0">Detail Pemesanan</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border border-gray-200 rounded-md p-4">
                
            </div>

        </div>
    </div>


    {{-- Footer --}}
    @include('components.footer-user')

</body>

</html>
