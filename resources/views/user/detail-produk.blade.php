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

    {{-- Calendar Format --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script> <!-- Lokal Bahasa Indonesia -->

    <!-- Tailwind CSS -->
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css'])

</head>
{{-- bg-gradient-to-b from-emerald-100 to-slate-200 --}}

<body class=" bg-gradient-to-b from-emerald-50 to-slate-200 pt-20">

    {{-- Navbar --}}
    @include('components.navbar-user')


    {{-- Konten di Sini --}}
    <div class="max-w-5xl mx-auto py-8">
        @php
            $hargaSewa = $barang->hargaSewas->where('durasi_jam', 24)->first() ?? $barang->hargaSewas->skip(1)->first();
        @endphp
        <div class="bg-white border p-6 rounded-lg shadow-lg mx-2">
            <div class="grid lg:grid-cols-2 gap-6 lg:gap-12">
                <div>
                    <img src="{{ asset('storage/barangs/' . $barang->image) }}" alt="{{ $barang->nama_barang }}"
                        class="w-full rounded-lg mx-auto mb-3">
                    <h3 class="block lg:hidden text-xl font-bold">{{ $barang->nama_barang }}</h3>
                    <p class="block lg:hidden space-x-3 text-lg text-green-600 font-semibold mb-5">
                        <span>Harga Sewa: Rp {{ number_format($hargaSewa->harga ?? 0, 0, ',', '.') }}</span>
                        <span class="text-gray-600 font-semibold text-sm">/ 1 hari</span>
                    </p>
                    <h3 class="text-lg font-semibold py-4 border-t-2 border-gray-300">Deskripsi Produk :</h3>
                    <p class="text-gray-600 text-sm mt-2">
                        {{ $barang->deskripsi }}
                    </p>
                </div>
                <div class="">
                    <div>
                        <h3 class="hidden lg:block text-2xl font-bold">{{ $barang->nama_barang }}</h3>
                        <p class="hidden lg:block space-x-3 text-2xl text-green-600 font-semibold">
                            <span>Harga Sewa: Rp {{ number_format($hargaSewa->harga ?? 0, 0, ',', '.') }}</span>
                            <span class="text-gray-600 font-semibold text-sm">/ 1 hari</span>
                        </p>

                        <div class="space-y-2 rounded-lg mt-2">
                            <h3 class="font-semibold">Durasi Sewa</h3>
                            @foreach ($barang->hargaSewas as $hargaSewa)
                                <div class="flex justify-between bg-gray-100 p-3 rounded-md border border-gray-300">
                                    <span>
                                        @switch($hargaSewa->durasi_jam)
                                            @case(12)
                                                12 Jam
                                            @break

                                            @case(24)
                                                1 Hari
                                            @break

                                            @case(48)
                                                2 Hari
                                            @break

                                            @case(72)
                                                3 Hari
                                            @break

                                            @default
                                                {{ $hargaSewa->durasi_jam }} Jam
                                        @endswitch
                                    </span>
                                    <span class="font-bold text-red-700">
                                        Rp {{ number_format($hargaSewa->harga, 0, ',', '.') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        {{-- <p class="text-red-600 text-sm bg-red-100 p-2 rounded-md mt-1.5 font-semibold">
                            *Harga sewa belum termasuk biaya pengiriman
                        </p> --}}
                    </div>

                    <div
                        class="bg-white shadow-lg shadow-emerald-100 border border-gray-400 lg:border-gray-200 p-4 rounded-lg mt-8 text-sm">
                        <h3 class="text-xl font-bold text-center mb-6">Form Sewa</h3>
                        <form action="{{ route('tambah.keranjang') }}" method="POST">

                            @csrf
                            <input type="hidden" name="barang_id" value="{{ $barang->id }}">

                            <div class="mb-3">
                                <label class="block text-xs font-semibold text-gray-600">Durasi Sewa :</label>
                                <select name="durasi_jam" id="durasi_jam"
                                    class="w-full p-3 rounded border mt-1 focus:outline-none focus:ring focus:ring-emerald-100"
                                    required>
                                    <option value="">Pilih Durasi</option>
                                    @foreach ($barang->hargaSewas as $hargaSewa)
                                        <option value="{{ $hargaSewa->durasi_jam }}">
                                            {{ $hargaSewa->durasi_jam == 12 ? 'Setengah Hari' : floor($hargaSewa->durasi_jam / 24) . ' Hari' }}
                                            - Rp {{ number_format($hargaSewa->harga, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex space-x-3 mb-3">
                                <div class="w-full">
                                    <label class="block text-xs font-semibold text-gray-600">Tanggal Mulai :</label>
                                    <input type="text" name="tanggal_mulai" id="tanggal_mulai"
                                        class="w-full p-3 rounded border mt-1 focus:outline-none focus:ring focus:ring-emerald-100"
                                        required>
                                </div>

                                <div class="w-full">
                                    <label class="block text-xs font-semibold text-gray-600">Tanggal Selesai :</label>
                                    <input type="text" name="tanggal_selesai" id="tanggal_selesai"
                                        class="w-full p-3 rounded border mt-1 focus:outline-none focus:ring focus:ring-emerald-100"
                                        readonly>
                                </div>
                            </div>


                            <a href="">
                                <button
                                    class="w-full mt-8 bg-gray-800 hover:bg-gray-700 text-white p-4 rounded focus:scale-95 duration-300">Masukkan
                                    Keranjang</button>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Footer --}}
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

    const tanggalMulaiInput = document.getElementById('tanggal_mulai');
    const tanggalSelesaiInput = document.getElementById('tanggal_selesai');
    const durasiSelect = document.getElementById('durasi_jam');

    // Flatpickr untuk Tanggal Mulai
    flatpickr(tanggalMulaiInput, {
        dateFormat: "Y-m-d", // format untuk value yang dikirim
        altInput: true,
        altFormat: "d M, Y", // format yang ditampilkan ke user
        minDate: "today", // disable tanggal sebelumnya
        onChange: hitungTanggalSelesai
    });

    // Flatpickr untuk Tanggal Selesai (readonly, jadi tidak bisa pilih manual)
    const fpSelesai = flatpickr(tanggalSelesaiInput, {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d M, Y",
        clickOpens: false
    });

    function hitungTanggalSelesai() {
        const durasiJam = parseInt(durasiSelect.value);
        const tanggalMulai = tanggalMulaiInput.value;

        if (!isNaN(durasiJam) && tanggalMulai) {
            const mulai = new Date(tanggalMulai);
            mulai.setHours(mulai.getHours() + durasiJam);

            const yyyy = mulai.getFullYear();
            const mm = String(mulai.getMonth() + 1).padStart(2, '0');
            const dd = String(mulai.getDate()).padStart(2, '0');
            const hasilFormat = `${yyyy}-${mm}-${dd}`;

            // Set value ke Flatpickr selesai
            fpSelesai.setDate(hasilFormat, true); // true agar update altInput juga
        }
    }

    durasiSelect.addEventListener('change', hitungTanggalSelesai);
</script>
