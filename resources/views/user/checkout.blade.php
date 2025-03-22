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

<body class=" bg-gradient-to-b from-emerald-50 to-slate-200 pt-20 text-sm">

    {{-- Navbar --}}
    @include('components.navbar-user')


    {{-- Konten di Sini --}}
    <div class="max-w-2xl lg:max-w-6xl mx-auto py-8 mb-20">
        <div class="bg-white border p-1 md:p-4 rounded-lg shadow-lg mx-4">

            {{-- Info USer --}}
            <div class="my-2 px-4">
                <h2 class="text-gray-700 text-2xl font-semibold text-center md:text-start mb-2 md:mb-0">CheckOut</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 rounded-md p-4 mb-6">
                <div class="">
                    <div class="space-y-4 bg-white  border border-gray-200 p-4 rounded shadow-md mb-5 lg:sticky top-24">
                        <h2 class="text-gray-700 text-lg font-semibold text-center md:text-start mb-5">Informasi Saya
                        </h2>
                        <div class="flex flex-col space-y-1">
                            <h5 class="text-gray-700 text-xs">Nama :</h5>
                            <h3 class="">Fuji Saskia</h3>
                        </div>

                        <div class="flex flex-col space-y-1">
                            <h5 class="text-gray-700 text-xs">No Telepon :</h5>
                            <h3 class="">089211223344</h3>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <h5 class="text-gray-700 text-xs">Alamat :</h5>
                            <h3 class="pr-8">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos
                                nihil alias doloribus.</h3>
                        </div>

                        <div class="">
                            <h5 class="font-semibold text-yellow-500">Ubah Alamat</h5>
                        </div>
                    </div>

                    <div class=" p-4 bg-white border border-gray-200 rounded shadow-md lg:sticky top-2/3">
                        <p class="font-semibold text-gray-800 text-lg">
                            Pilih <span class="font-bold">??????</span>
                        </p>
                        <div class="flex justify-around mt-3">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="delivery" class="form-radio text-gray-600" />
                                <span class="text-gray-700 font-medium">Antar-Jemput</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="delivery" class="form-radio text-gray-600" />
                                <span class="text-gray-700 font-medium">Ambil Sendiri</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="border border-gray-200 p-4 rounded shadow-md items-center">
                    <h2 class="text-gray-700 text-lg font-semibold text-center md:text-start mb-5">Rincian Pemesanan
                    </h2>

                    <div class="flex flex-col space-y-2 mb-2">
                        <div class="flex space-x-2 bg-gray-50 border rounded p-1.5 items-center">
                            <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                                alt="" class="w-16 h-16 rounded border border-gray-300">
                            <div class="flex-1">
                                <h4 class="font-bold text-base">PS-5 XX</h4>
                                <p class="text-gray-600 text-xs ">06 March, 2025 - 08 March, 2025</p>
                                <div class="flex space-x-2 font-semibold text-gray-800 justify-between text-sm  mt-3">
                                    <h5>2 Hari</h5>
                                    <h4>RP 50,000</h4>
                                </div>
                            </div>
                        </div>

                        <div class="flex space-x-2 bg-gray-50 border rounded p-1.5 items-center">
                            <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                                alt="" class="w-16 h-16 rounded border border-gray-300">
                            <div class="flex-1">
                                <h4 class="font-bold text-base">PS-5 XX</h4>
                                <p class="text-gray-600 text-xs ">06 March, 2025 - 08 March, 2025</p>
                                <div class="flex space-x-2 font-semibold text-gray-800 justify-between text-sm  mt-3">
                                    <h5>2 Hari</h5>
                                    <h4>RP 50,000</h4>
                                </div>
                            </div>
                        </div>

                        <div class="flex space-x-2 bg-gray-50 border rounded p-1.5 items-center">
                            <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                                alt="" class="w-16 h-16 rounded border border-gray-300">
                            <div class="flex-1">
                                <h4 class="font-bold text-base">PS-5 XX</h4>
                                <p class="text-gray-600 text-xs ">06 March, 2025 - 08 March, 2025</p>
                                <div class="flex space-x-2 font-semibold text-gray-800 justify-between text-sm  mt-3">
                                    <h5>2 Hari</h5>
                                    <h4>RP 50,000</h4>
                                </div>
                            </div>
                        </div>

                        <div class="flex space-x-2 bg-gray-50 border rounded p-1.5 items-center">
                            <img src="{{ asset('assets/kabel.png') }}" alt=""
                                class="w-16 h-16 rounded border border-gray-300">
                            <div class="flex-1">
                                <h4 class="font-bold text-base">PS-5 XX</h4>
                                <p class="text-gray-600 text-xs ">06 March, 2025 - 08 March, 2025</p>
                                <div class="flex space-x-2 font-semibold text-gray-800 justify-between text-sm  mt-3">
                                    <h5>2 Hari</h5>
                                    <h4>RP 50,000</h4>
                                </div>
                            </div>
                        </div>

                        <div class="flex space-x-2 bg-gray-50 border rounded p-1.5 items-center">
                            <img src="{{ asset('assets/kabel.png') }}" alt=""
                                class="w-16 h-16 rounded border border-gray-300">
                            <div class="flex-1">
                                <h4 class="font-bold text-base">PS-5 XX</h4>
                                <p class="text-gray-600 text-xs ">06 March, 2025 - 08 March, 2025</p>
                                <div class="flex space-x-2 font-semibold text-gray-800 justify-between text-sm  mt-3">
                                    <h5>2 Hari</h5>
                                    <h4>RP 50,000</h4>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Ongkir Section -->
                    <div class="flex justify-between space-x-2 bg-gray-50 border rounded px-2 py-1.5 items-center">
                        <div>
                            <p class="font-bold text-gray-800">Ongkir</p>
                            <p class="text-gray-600 text-xs">Antar-Jemput</p>
                        </div>
                        <p class="font-bold">Rp 20,000</p>
                    </div>

                    <!-- Input Kode Diskon -->
                    <div class="flex my-3 bg-gray-100 p-2.5 rounded-lg">
                        <input type="text" placeholder="Masukkan Kode Diskon"
                            class="bg-transparent text-gray-600 w-full outline-none" />
                        <button
                            class="bg-emerald-700 hover:bg-emerald-800 text-white px-4 py-1.5 rounded font-semibold">
                            Gunakan
                        </button>
                    </div>

                    <!-- Total -->
                    <div class="flex justify-between items-center">
                        <p class="font-bold text-xl">TOTAL</p>
                        <p class="text-red-700 font-bold text-xl">Rp 100,000</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 mt-4">
                        <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 w-full py-3 rounded-lg font-bold">
                            Batal
                        </button>
                        <button class="bg-black hover:bg-gray-700 text-white w-full py-3 rounded-lg font-bold">
                            Bayar
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
