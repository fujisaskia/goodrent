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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css'])

</head>
{{-- bg-gradient-to-b from-emerald-100 to-slate-200 --}}

<body class=" bg-gradient-to-b from-emerald-50 to-slate-200 pt-20 text-sm overflow-auto">

    {{-- Navbar --}}
    @include('components.navbar-user')

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    {{-- Konten di Sini --}}
    <div class="max-w-2xl lg:max-w-6xl mx-auto py-8 mb-20">
        <div class="border p-1 md:p-4 rounded-lg shadow-lg">

            {{-- Info USer --}}
            <div class="my-2 px-4">
                <h2 class="text-gray-700 text-2xl md:text-3xl font-semibold text-center md:text-start mb-2 md:mb-0">
                    CheckOut</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 rounded-md p-4 mb-6">
                <div class="">
                    <div class="space-y-4 bg-white  border border-gray-200 p-4 rounded shadow-md mb-5 lg:sticky top-24">
                        <h2 class="text-gray-700 text-lg font-semibold text-center md:text-start mb-5">Informasi Saya
                        </h2>
                        <div class="flex flex-col space-y-1">
                            <h5 class="text-gray-700 text-xs">Nama :</h5>
                            <h3 class="">{{ Auth::user()->name }}</h3>
                        </div>

                        <div class="flex flex-col space-y-1">
                            <h5 class="text-gray-700 text-xs">Email :</h5>
                            <h3 class="">{{ Auth::user()->email }}</h3>
                        </div>

                        <div class="flex flex-col space-y-1">
                            <h5 class="text-gray-700 text-xs">No Telepon :</h5>
                            <h3 class="">{{ Auth::user()->no_telp }}</h3>
                        </div>
                    </div>

                    {{-- <div class=" p-4 bg-white border border-gray-200 rounded shadow-md lg:sticky top-2/3">
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
                    </div> --}}
                </div>

                <div class="bg-white border border-gray-200 p-4 rounded shadow-md items-center">
                    <h2 class="text-gray-700 text-lg font-semibold text-center md:text-start mb-5">Rincian Pemesanan
                    </h2>

                    <div class="flex flex-col space-y-2 mb-2">
                        @foreach ($pesanan->items as $item)
                            <div class="flex space-x-2 bg-gray-50 border rounded p-1.5 items-center">
                                <img src="{{ asset('storage/barangs/' . $item->barang->image) }}"
                                    alt="{{ $item->barang->nama_barang }}"
                                    class="w-16 h-16 rounded border border-gray-300">
                                <div class="flex-1">
                                    <h4 class="font-bold text-base">{{ $item->barang->nama_barang }}</h4>
                                    <p class="text-gray-600 text-xs ">
                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M, Y') }} -
                                        {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M, Y') }}
                                    </p>
                                    <div
                                        class="flex space-x-2 font-semibold text-gray-800 justify-between text-sm mt-3">
                                        <h5>
                                            @if ($item->durasi_sewa >= 24)
                                                {{ floor($item->durasi_sewa / 24) }} Hari
                                            @else
                                                {{ $item->durasi_sewa }} Jam
                                            @endif
                                        </h5>
                                        <h4>Rp {{ number_format($item->harga_barang, 0, ',', '.') }}</h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pilih Diskon -->
                    <div class="flex space-x-3 my-3">
                        <span id="selected-discount"
                            class="bg-emerald-50 font-bold border border-blue-300 rounded p-3 text-gray-600 w-full outline-none cursor-pointer"
                            onclick="toggleDiscountModal()">PILIH DISKON</span>
                        <button id="apply-discount-button"
                            class="bg-emerald-700 hover:bg-emerald-800 text-white px-5 py-3 rounded font-semibold"
                            disabled onclick="applyDiscount()">Pakai</button>

                    </div>

                    <!-- Modal Daftar Diskon -->
                    <div id="discount-modal"
                        class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center p-4 font-semibold z-50">
                        <div class="bg-white p-6 rounded-lg w-96 max-h-[80vh] relative">
                            <!-- Tombol X -->
                            <button onclick="closeDiscountModal()"
                                class="absolute top-4 right-4 text-gray-500 hover:bg-gray-200 rounded-full hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <h2 class="text-xl font-bold mb-4">Pilih Diskon</h2>


                            <!-- Scrollable Diskon List -->
                            <div class="overflow-y-auto max-h-80 pr-2">
                                @foreach ($diskons as $diskon)
                                    <div onclick="selectDiscount('{{ $diskon->nama_diskon }}', '{{ $diskon->id }}', '{{ number_format($diskon->besar_diskon, 0, ',', '.') }}')"
                                        class="cursor-pointer p-3 border border-gray-300 text-gray-700 hover:bg-emerald-50 mb-2 rounded">
                                        <p class="text-base font-semibold text-emerald-700">{{ $diskon->nama_diskon }}
                                        </p>
                                        <p class="text-sm text-gray-500">Potongan s/d
                                            {{ number_format($diskon->besar_diskon, 0, ',', '.') }}</p>
                                    </div>
                                @endforeach
                            </div>

                            {{-- <button onclick="closeDiscountModal()"
                                class="mt-4 w-full bg-red-600 text-white py-2 rounded">Tutup</button> --}}
                        </div>
                    </div>


                    {{-- status diskon --}}
                    {{-- <p class="p-2 mb-4 text-xs border border-emerald-700 bg-emerald-100">🎉 Diskon berhasil digunakan! hemat sebesar Rp</p> --}}
                    <p id="status-diskon" class="hidden p-2 mb-4 text-xs border border-emerald-700 bg-emerald-100">
                        🎉 Diskon berhasil digunakan! Hemat sebesar <span id="nominal-diskon"></span>
                    </p>


                    <!-- Total -->
                    <div class="flex justify-between items-center">
                        <p class="font-bold text-xl">TOTAL</p>
                        <p id="total-bayar" class="text-red-700 font-bold text-xl">
                            Rp{{ number_format($pesanan->total_bayar, 0, ',', '.') }}</p>
                    </div>


                    <!-- Buttons Pembayaran-->
                    <div class="flex gap-3 mt-4">
                        <form action="{{ route('checkout.batal', $pesanan->id) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 w-full py-3 rounded-lg font-bold">
                                Batal
                            </button>
                        </form>
                        <!-- Tombol Bayar -->
                        <button id="bayar-button" type="button" data-pesanan-id="{{ $pesanan->id }}"
                            class="bg-black hover:bg-gray-800 text-white w-full py-3 rounded-lg font-bold focus:scale-95 duration-300">
                            Bayar
                        </button>
                    </div>

                    <!-- Modal Metode Pembayaran -->
                    <div id="metodeModal"
                        class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 px-4 flex items-center justify-center">
                        <div class="bg-white relative rounded-lg p-6 w-96 shadow-lg text-center">
                            <!-- Tombol X di pojok kanan atas -->
                            <button id="closeModal"
                                class="absolute top-4 right-4 p-1.5 text-gray-500 hover:text-gray-800 hover:bg-gray-200 text-2xl font-bold rounded-full focus:scale-95 duration-300">
                                <i class="fa-solid fa-xmark"></i>
                            </button>

                            <h2 class="text-xl font-bold mt-4">Pilih Metode Pembayaran</h2>
                            <img src="{{ asset('assets/question.jpg') }}" alt="pilih metode pembayaran"
                                class="mx-auto my-4 w-52">
                            <div class="flex space-x-3">
                                <button id="tunai-button"
                                    class="w-full bg-yellow-500 hover:bg-yellow-600 text-white p-3 rounded focus:scale-95 duration-300">Tunai</button>
                                <button id="digital-button"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white p-3 rounded focus:scale-95 duration-300">Digital</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const bayarButton = document.getElementById('bayar-button');
            const metodeModal = document.getElementById('metodeModal');
            const tunaiBtn = document.getElementById('tunai-button');
            const digitalBtn = document.getElementById('digital-button');
            const closeModal = document.getElementById('closeModal');

            let pesananId = null;

            bayarButton.addEventListener('click', function() {
                pesananId = this.getAttribute('data-pesanan-id');
                if (!pesananId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Pesanan tidak ditemukan.',
                    });
                    return;
                }
                metodeModal.classList.remove('hidden');
            });

            closeModal.addEventListener('click', () => {
                metodeModal.classList.add('hidden');
            });

            // TUNAI
            tunaiBtn.addEventListener('click', () => {
                metodeModal.classList.add('hidden');

                const pesananId = document.getElementById('bayar-button').getAttribute('data-pesanan-id');

                if (!pesananId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Pesanan tidak ditemukan.',
                    });
                    return;
                }

                // Mengirimkan data pesanan_id di body request
                fetch(`/goodrent/proses-pembayaran-tunai/${pesananId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        body: JSON.stringify({
                            pesanan_id: pesananId, // Kirimkan pesanan_id
                        }),
                    })
                    .then(res => {
                        if (!res.ok) {
                            throw new Error('Gagal memproses pembayaran tunai');
                        }
                        return res.json();
                    })
                    .then(data => {
                        if (data.redirect) {
                            Swal.fire({
                                title: 'Pembayaran Berhasil!',
                                imageUrl: '/assets/cash.png',
                                imageWidth: 250,
                                imageHeight: 250,
                                confirmButtonText: 'Lihat Pemesanan',
                                confirmButtonColor: '#047857',
                                background: '#f8f9fa',
                                customClass: {
                                    title: 'text-xl',
                                    confirmButton: 'px-8',
                                }
                            }).then(() => {
                                window.location.href = data.redirect; // redirect setelah sukses
                            });
                        } else {
                            throw new Error('Data tidak memiliki redirect');
                        }
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan saat pembayaran tunai:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Memproses Pembayaran!',
                            text: 'Silakan coba lagi atau hubungi admin.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#dc2626',
                            background: '#fef2f2',
                        });
                    });
            });


            // DIGITAL (tidak diubah)
            digitalBtn.addEventListener('click', () => {
                metodeModal.classList.add('hidden');

                fetch(`/goodrent/proses-pembayaran/${pesananId}`)
                    .then(response => {
                        if (!response.ok) throw new Error("Gagal ambil token");
                        return response.json();
                    })
                    .then(data => {
                        snap.pay(data.snapToken, {
                            onSuccess: function(result) {
                                fetch("{{ route('pembayaran.success') }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                        },
                                        body: JSON.stringify({
                                            order_id: result.order_id,
                                            status: result.transaction_status
                                        })
                                    }).then(res => res.json())
                                    .then(data => {
                                        Swal.fire({
                                            title: 'Pembayaran Berhasil!',
                                            imageUrl: '/assets/card-payment.png',
                                            imageWidth: 200,
                                            imageHeight: 200,
                                            confirmButtonText: 'Lihat Pemesanan',
                                            confirmButtonColor: '#047857',
                                            background: '#f8f9fa',
                                            customClass: {
                                                title: 'text-xl',
                                                confirmButton: 'px-8',
                                            }
                                        }).then(() => {
                                            window.location.href =
                                                '/goodrent/riwayat/pemesanan-saya';
                                        });
                                    });
                            },
                            onPending: function() {
                                Swal.fire({
                                    title: 'Pembayaran Tertunda!',
                                    imageUrl: '/assets/waiting.png',
                                    imageWidth: 200,
                                    imageHeight: 200,
                                    confirmButtonText: 'Lanjut Bayar',
                                    confirmButtonColor: '#ea580c',
                                    background: '#f8f9fa',
                                }).then(() => {
                                    window.location.href =
                                        '/goodrent/riwayat/pemesanan-saya';
                                });
                            },
                            onError: function(result) {
                                console.error("Maaf! Terjadi Kesalahan", result);
                            }
                        });
                    })
                    .catch(error => console.error("Fetch token error:", error));
            });
        });
    </script>



</body>

</html>


<script>
    function toggleDiscountModal() {
        const modal = document.getElementById('discount-modal');
        modal.classList.toggle('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDiscountModal() {
        const modal = document.getElementById('discount-modal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Fungsi untuk memilih diskon
    function selectDiscount(namaDiskon, diskonId, besarDiskon) {
        const discountText = document.getElementById('selected-discount');
        const applyButton = document.getElementById('apply-discount-button');

        // Menampilkan diskon yang dipilih
        discountText.textContent = `${namaDiskon} - Potongan s/d ${number_format(besarDiskon)}`;

        // Menyimpan diskon yang dipilih (diskon_id dan besar_diskon)
        discountText.setAttribute('data-diskon-id', diskonId);
        discountText.setAttribute('data-besar-diskon', besarDiskon);

        // Mengaktifkan tombol "Pakai"
        applyButton.disabled = false;

        // Menutup modal setelah memilih
        closeDiscountModal();
    }


    // Format angka untuk tampilan diskon
    function number_format(amount) {
        return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }


    function applyDiscount() {
        const selected = document.getElementById('selected-discount');
        const diskonId = selected.getAttribute('data-diskon-id');
        const besarDiskon = parseFloat(selected.getAttribute('data-besar-diskon'));

        if (!diskonId) {
            alert('Pilih diskon terlebih dahulu!');
            return;
        }

        $.ajax({
            url: '/goodrent/checkout/pakai-diskon',
            method: 'POST',
            data: {
                diskon_id: diskonId,
                potongan_harga: besarDiskon,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                Swal.fire({
                    toast: true,
                    text: 'Diskon berhasil diterapkan',
                    icon: 'success',
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: false
                });

                // Tampilkan status diskon dengan format ribuan
                const statusDiskon = document.getElementById('status-diskon');
                const nominalDiskon = document.getElementById('nominal-diskon');

                nominalDiskon.textContent = 'Rp' + besarDiskon.toLocaleString('id-ID');
                statusDiskon.classList.remove('hidden');

                // Perbarui total bayar
                document.getElementById('total-bayar').textContent = 'Rp' + response.total_bayar
                    .toLocaleString('id-ID');
            },
            error: function(error) {
                alert('Gagal menerapkan diskon');
            }
        });
    }



    // Fungsi untuk menerapkan diskon pada pesanan
    // function applyDiscount() {
    //     const diskonId = document.getElementById('selected-discount').getAttribute('data-diskon-id');
    //     const besarDiskon = parseFloat(document.getElementById('selected-discount').getAttribute('data-besar-diskon'));

    //     if (!diskonId) {
    //         alert('Pilih diskon terlebih dahulu!');
    //         return;
    //     }

    //     // Kirim data diskon ke server
    //     $.ajax({
    //         url: '/goodrent/checkout/pakai-diskon', // Ganti dengan rute yang sesuai
    //         method: 'POST',
    //         data: {
    //             diskon_id: diskonId,
    //             potongan_harga: besarDiskon,
    //             _token: '{{ csrf_token() }}' // Pastikan CSRF token ada
    //         },
    //         success: function(response) {
    //             // Gunakan SweetAlert untuk menampilkan pesan
    //             Swal.fire({
    //                 toast: true,
    //                 text: 'Diskon berhasil diterapkan',
    //                 icon: 'success',
    //                 position: "top-end",
    //                 showConfirmButton: false,
    //                 timer: 3000,
    //                 timerProgressBar: true
    //             });
    //             // Perbarui total bayar di UI jika perlu
    //             // Misalnya, perbarui total bayar yang ditampilkan
    //             document.getElementById('total-bayar').textContent = 'Rp' + response.total_bayar;
    //         },
    //         error: function(error) {
    //             alert('Gagal menerapkan diskon');
    //         }
    //     });
    // }


    // Tampilkan Snap Pembayaran 
    // document.getElementById('pay-button').onclick = function () {
    //     const pesananId = this.getAttribute('data-pesanan-id');

    //     fetch(`/goodrent/proses-pembayaran/${pesananId}`)
    //         .then(res => {
    //             if (!res.ok) throw new Error('Gagal ambil snap token');
    //             return res.json();
    //         })
    //         .then(data => {
    //             snap.pay(data.snap_token, {
    //                 onSuccess: function(result) {
    //                     fetch("{{ route('pembayaran.success') }}", {
    //                         method: "POST",
    //                         headers: {
    //                             "Content-Type": "application/json",
    //                             "X-CSRF-TOKEN": "{{ csrf_token() }}"
    //                         },
    //                         body: JSON.stringify({
    //                             order_id: result.order_id
    //                         })
    //                     })
    //                     .then(res => res.json())
    //                     .then(data => {
    //                         if (data.redirect) window.location.href = data.redirect;
    //                     });
    //                 }
    //             });
    //         })
    //         .catch(err => console.error('Snap error:', err));
    // };
</script>
