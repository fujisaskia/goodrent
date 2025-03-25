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
    <div class="max-w-3xl lg:max-w-6xl mx-auto py-8 mb-10 md:mb-24">
        <!-- Judul Halaman -->
        <h2 class="text-center md:text-start text-gray-700 text-3xl font-semibold md:ml-4 mb-4">Keranjang</h2>
        <div class="flex flex-col lg:flex-row space-x-4">
            <div class="flex-1 space-y-2 mx-4">   
                <!-- ITEM 1 -->
                <div class="flex items-start space-x-3 p-4 rounded-t-lg shadow-sm bg-white border-b border-gray-200 hover:bg-gray-50 duration-200">
            
                    <!-- Gambar produk -->
                    <img
                        src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                        alt="Foto Produk"
                        class="w-20 h-20 rounded border border-gray-300"
                    />
            
                    <!-- Info produk -->
                    <div class="flex-1">
                        <div class="flex space-x-3 justify-center items-center">
                            <div class="flex-1">
                                <!-- Nama Produk -->
                                <h3 class="font-semibold">Play station 5</h3>
                                <!-- Tanggal Sewa -->
                                <p class="text-xs text-gray-700">
                                    06 Maret, 2025 - 07 Maret, 2025
                                </p>
                                <!-- Durasi -->
                                <p class="text-xs text-gray-700">
                                    2 Hari
                                </p>
                            </div>

                            <!-- Harga & Tombol Hapus -->
                            <div class="flex text-base">
                                <span class="text-gray-800 font-bold">Rp41.817</span>
                            </div>
                            
                        </div>
                        <div class="flex justify-end">
                            <button
                                class="text-base p-2 mt-2 text-gray-600 hover:text-gray-800 hover:bg-gray-300 rounded-full"
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                              </svg>                          
                            </button>

                        </div>
                    </div>
            
                </div>   
                <!-- ITEM 2 -->
                <div class="flex items-start space-x-3 p-4 rounded-none shadow-sm bg-white border-b border-gray-200 hover:bg-gray-50 duration-200">
            
                    <!-- Gambar produk -->
                    <img
                        src="{{ asset('assets/kabel.png') }}"
                        alt="Foto Produk"
                        class="w-20 h-20 rounded border border-gray-300"
                    />
            
                    <!-- Info produk -->
                    <div class="flex-1">
                        <div class="flex space-x-3 justify-center items-center">
                            <div class="flex-1">
                                <!-- Nama Produk -->
                                <h3 class="font-semibold">Play station 5</h3>
                                <!-- Tanggal Sewa -->
                                <p class="text-xs text-gray-700">
                                    06 Maret, 2025 - 07 Maret, 2025
                                </p>
                                <!-- Durasi -->
                                <p class="text-xs text-gray-700">
                                    2 Hari
                                </p>
                            </div>

                            <!-- Harga & Tombol Hapus -->
                            <div class="flex text-base">
                                <span class="text-gray-800 font-bold">Rp41.817</span>
                            </div>
                            
                        </div>
                        <div class="flex justify-end">
                            <button
                                class="text-base p-2 mt-2 text-gray-600 hover:text-gray-800 hover:bg-gray-300 rounded-full"
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                              </svg>                          
                            </button>

                        </div>
                    </div>
            
                </div>
                <!-- ITEM 3 -->
                <div class="flex items-start space-x-3 p-4 rounded-b-lg shadow-sm bg-white border-b border-gray-200 hover:bg-gray-50 duration-200">
            
                    <!-- Gambar produk -->
                    <img
                        src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                        alt="Foto Produk"
                        class="w-20 h-20 rounded border border-gray-300"
                    />
            
                    <!-- Info produk -->
                    <div class="flex-1">
                        <div class="flex space-x-3 justify-center items-center">
                            <div class="flex-1">
                                <!-- Nama Produk -->
                                <h3 class="font-semibold">Play station 5</h3>
                                <!-- Tanggal Sewa -->
                                <p class="text-xs text-gray-700">
                                    06 Maret, 2025 - 07 Maret, 2025
                                </p>
                                <!-- Durasi -->
                                <p class="text-xs text-gray-700">
                                    2 Hari
                                </p>
                            </div>

                            <!-- Harga & Tombol Hapus -->
                            <div class="flex text-base">
                                <span class="text-gray-800 font-bold">Rp41.817</span>
                            </div>
                            
                        </div>
                        <div class="flex justify-end">
                            <button
                                class="text-base p-2 mt-2 text-gray-600 hover:text-gray-800 hover:bg-gray-300 rounded-full"
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                              </svg>                          
                            </button>

                        </div>
                    </div>
            
                </div>

            </div>
            

            <div class="flex">
                {{-- ringkasan harga --}}
                <div class="md:sticky md:top-24 fixed bottom-0 left-0 w-full md:w-80 bg-white h-52 md:h-44 shadow-sm rounded-lg p-4">
                    <h3 class="font-semibold text-gray-800 text-base">Ringkasan belanja</h3>
                    
                    <div class="flex justify-between items-center mt-3 pb-3 border-b">
                        <span class="text-gray-700">Total</span>
                        <span class="text-black font-bold text-lg">Rp103,632</span>
                    </div>

                    <button class="bg-gray-800 hover:bg-gray-900 text-white font-bold rounded-lg py-4 md:py-3 w-full mt-4">
                        Checkout
                    </button>
                </div>

                
            </div>


            
        </div>
    </div>

</body>

</html>
