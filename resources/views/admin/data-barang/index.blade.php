@extends('layouts/admin')

@section('title', 'Data Barang GoodRent')

@section('content')

    <div class="mx-auto p-2">
        <h2 class="flex space-x-3 text-2xl md:text-3xl font-bold mb-4 items-center justify-center md:justify-start">
            <i class="fa-solid fa-box-open text-emerald-800"></i>
            <span>Data Barang</span>
        </h2>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row justify-between mb-4">
                <div class="flex space-x-3 mb-2 md:mb-0">
                    <input type="search" placeholder="Cari Barang"
                        class="border p-3 rounded-lg w-60 focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                    <button class="py-3 px-4 bg-emerald-600 rounded-full text-white focus:scale-95 duration-300">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                <div class="flex justify-end">
                    <button onclick="openModalTambahBarang()"
                        class="bg-green-700 hover:bg-green-800 flex space-x-2 text-white p-3 rounded-lg items-center focus:scale-95 duration-300">
                        <i class="fa-solid fa-plus"></i>
                        <span>Tambah Barang</span>
                    </button>

                    {{-- Modal Tambah Data Barang  --}}
                    @include('admin.data-barang.create')
                </div>
            </div>

            <div class="overflow-x-auto lg:overflow-visible">
                <table class="w-full border-collapse border rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-500 text-white uppercase">
                            <th class="p-3">no</th>
                            <th class="p-3">Jenis PS</th>
                            <th class="p-3">foto barang</th>
                            <th class="p-3">deskripsi</th>
                            <th class="p-3">harga sewa</th>
                            <th class="p-3">aksi</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr class="border-b text-center hover:bg-gray-50">
                            <td class="p-3 ">1</td>
                            <td class="p-3">Lorem ipsum dolor sit amet.</td>
                            <td class="flex justify-center p-3">
                                <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                                    alt="" class="w-16 h-auto">
                            </td>
                            <td class="p-3">-</td>
                            <td class="p-3">RP 50,000 / jam</td>
                            <td class="p-3 flex items-center justify-center gap-2">
                                {{-- button lihat --}}
                                <a href="">
                                    @include('components.crud.read')
                                </a>

                                {{-- button edit --}}
                                <button
                                    class="btn-edit-barang bg-yellow-500 hover:bg-yellow-600 shadow-md shadow-yellow-300 hover:shadow-none focus:scale-95 duration-300 
                                       text-white py-2 px-2.5 rounded-full"
                                    title="Edit Barang" data-id="">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                {{-- Modal Tambah Data Barang  --}}
                                @include('admin.data-barang.edit')

                                {{-- button hapus --}}
                                <form action="" id="delete-form">
                                    @include('components.crud.delete')
                                </form>
                            </td>
                        </tr>
                        <tr class="border-b text-center hover:bg-gray-50">
                            <td class="p-3 ">2</td>
                            <td class="p-3">Lorem ipsum dolor sit amet.</td>
                            <td class="flex justify-center p-3">
                                <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                                    alt="" class="w-16 h-auto">
                            </td>
                            <td class="p-3">-</td>
                            <td class="p-3">RP 50,000 / jam</td>
                            <td class="p-3 flex items-center justify-center gap-2">
                                {{-- button lihat --}}
                                <a href="">
                                    @include('components.crud.read')
                                </a>

                                {{-- button edit --}}
                                <button
                                    class="btn-edit-barang bg-yellow-500 hover:bg-yellow-600 shadow-md shadow-yellow-300 hover:shadow-none focus:scale-95 duration-300 
                                       text-white py-2 px-2.5 rounded-full"
                                    title="Edit" data-barang-id="">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                {{-- Modal Tambah Data Barang  --}}
                                @include('admin.data-barang.edit')

                                {{-- button hapus --}}
                                <form action="" id="delete-form">
                                    @include('components.crud.delete')
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Pagination --}}
        <div class="flex justify-end space-x-1 mt-5">
            <button
                class="rounded-full bg-white border border-slate-300 py-2 px-3 items-center text-center transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-emerald-700 hover:border-emerald-700 focus:text-white focus:bg-emerald-700 focus:border-emerald-700 active:border-emerald-700 active:text-white active:bg-emerald-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button
                class="min-w-9 rounded-full bg-emerald-700 py-2 px-3.5 border border-transparent text-center text-white transition-all shadow-md hover:shadow-lg focus:bg-emerald-700 focus:shadow-none active:bg-emerald-700 hover:bg-emerald-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                1
            </button>
            <button
                class="min-w-9 bg-white rounded-full border border-slate-300 py-2 px-3.5 text-center transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-emerald-600 hover:border-emerald-700 focus:text-white focus:bg-emerald-700 focus:border-emerald-700 active:border-emerald-700 active:text-white active:bg-emerald-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                2
            </button>
            <button
                class="min-w-9 bg-white rounded-full border border-slate-300 py-2 px-3.5 text-center transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-emerald-600 hover:border-emerald-700 focus:text-white focus:bg-emerald-700 focus:border-emerald-700 active:border-emerald-700 active:text-white active:bg-emerald-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                3
            </button>
            <button
                class="min-w-9 bg-white rounded-full border border-slate-300 py-2 px-3 items-center text-center transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-emerald-600 hover:border-emerald-700 focus:text-white focus:bg-emerald-700 focus:border-emerald-700 active:border-emerald-700 active:text-white active:bg-emerald-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>

    </div>

    <script>
        document.querySelectorAll('#delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                Swal.fire({
                    title: "Yakin Hapus?",
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#9ca3af",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal",
                    customClass: {
                        confirmButton: 'rounded-full',
                        cancelButton: 'rounded-full'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('form')
                            .submit(); // Ambil form terdekat dari tombol yang diklik
                    }
                });
            });
        });

        // membuka modal tambah barang
        function openModalTambahBarang() {
            let overlay = document.getElementById('modal-overlay-tambah-barang');
            let modal = document.getElementById('modal-tambah-barang');

            // Tampilkan overlay
            overlay.classList.remove('hidden');

            // Beri jeda untuk animasi
            setTimeout(() => {
                modal.classList.remove('scale-95', 'opacity-0');
                modal.classList.add('scale-100', 'opacity-100');
            }, 50);

            document.body.classList.add('overflow-hidden'); // Mencegah scroll saat modal terbuka
        }
        // menutup modal tambah barang
        function closeModalTambahBarang() {
            let modal = document.getElementById('modal-tambah-barang');
            let overlay = document.getElementById('modal-overlay-tambah-barang');

            // Tambahkan animasi keluar
            modal.classList.add('scale-95', 'opacity-0');
            modal.classList.remove('scale-100', 'opacity-100');

            // Tunggu animasi selesai sebelum menyembunyikan modal
            setTimeout(() => {
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300); // Sesuai dengan durasi transition (300ms)
        }


        // membuka modal edit barang
        document.querySelectorAll('.btn-edit-barang').forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-barang-id');
                openModalEditBarang(itemId);
            });
        });

        function openModalEditBarang(id) {
            let overlay = document.getElementById('modal-overlay-edit-barang');
            let modal = document.getElementById('modal-edit-barang');

            // Bisa juga tambahkan logika untuk menampilkan data sesuai id

            overlay.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('scale-95', 'opacity-0');
                modal.classList.add('scale-100', 'opacity-100');
            }, 50);

            document.body.classList.add('overflow-hidden');
        }

        // menutup modal edit barang
        function closeModalEditBarang() {
            let modal = document.getElementById('modal-edit-barang');
            let overlay = document.getElementById('modal-overlay-edit-barang');

            // Tambahkan animasi keluar
            modal.classList.add('scale-95', 'opacity-0');
            modal.classList.remove('scale-100', 'opacity-100');

            // Tunggu animasi selesai sebelum menyembunyikan modal
            setTimeout(() => {
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300); // Sesuai dengan durasi transition (300ms)
        }
    </script>


@endsection
