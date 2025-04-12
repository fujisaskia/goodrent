@extends('layouts/admin')

@section('title', 'Kategori Diskon GoodRent')

@section('content')

    <div class="mx-auto p-2">
        <h2 class="flex space-x-3 text-2xl md:text-3xl font-bold mb-4 items-center justify-center md:justify-start">
            <i class="fa-solid fa-box-open text-emerald-800"></i>
            <span>Kategori Diskon</span>
        </h2>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row justify-between mb-4">
                <div class="flex space-x-3 mb-2 md:mb-0">
                    <input type="search" placeholder="Cari Kategori Diskon"
                        class="border p-3 rounded-lg w-60 focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                    <button class="py-3 px-4 bg-emerald-600 rounded-full text-white focus:scale-95 duration-300">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                <div class="flex justify-end">
                    <button onclick="openModalTambahKategoriDiskon()"
                        class="bg-green-700 hover:bg-green-800 flex space-x-2 text-white p-3 rounded-lg items-center focus:scale-95 duration-300">
                        <i class="fa-solid fa-plus"></i>
                        <span>Tambah Kategori</span>
                    </button>

                    {{-- Modal Tambah Data diskon  --}}
                    @include('admin.kategori-diskon.create')
                </div>
            </div>

            <div class="overflow-x-auto lg:overflow-visible">
                <table class="w-full border-collapse border rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-500 text-white uppercase">
                            <th class="p-3">no</th>
                            <th class="p-3">nama kategori</th>
                            <th class="p-3">aksi</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr class="border-b text-center hover:bg-gray-50">
                            <td class="p-3 ">1</td>
                            <td class="p-3 text-left">Diskon Imlek</td>
                            <td class="p-3 flex items-center justify-center gap-2">

                                {{-- button edit --}}
                                <button
                                    class="btn-edit-kategori-diskon bg-yellow-500 hover:bg-yellow-600 shadow-md shadow-yellow-300 hover:shadow-none focus:scale-95 duration-300 
                                       text-white py-2 px-2.5 rounded-full"
                                    title="Edit Kategori" data-kategori-id="">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                {{-- Modal Tambah Data diskon  --}}
                                @include('admin.kategori-diskon.edit')

                                {{-- button hapus --}}
                                <form action="" id="delete-form">
                                    @include('components.crud.delete')
                                </form>
                            </td>
                        </tr>
                        <tr class="border-b text-center hover:bg-gray-50">
                            <td class="p-3 ">2</td>
                            <td class="p-3 text-left">Ramadhan</td>
                            <td class="p-3 flex items-center justify-center gap-2">

                                {{-- button edit --}}
                                <button
                                    class="btn-edit-kategori-diskon bg-yellow-500 hover:bg-yellow-600 shadow-md shadow-yellow-300 hover:shadow-none focus:scale-95 duration-300 
                                       text-white py-2 px-2.5 rounded-full"
                                    title="Edit Kategori" data-kategori-id="">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                {{-- Modal Tambah Data diskon  --}}
                                @include('admin.kategori-diskon.edit')

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

        // membuka modal tambah diskon
        function openModalTambahKategoriDiskon() {
            let overlay = document.getElementById('modal-overlay-tambah-kategori-diskon');
            let modal = document.getElementById('modal-tambah-kategori-diskon');

            // Tampilkan overlay
            overlay.classList.remove('hidden');

            // Beri jeda untuk animasi
            setTimeout(() => {
                modal.classList.remove('scale-95', 'opacity-0');
                modal.classList.add('scale-100', 'opacity-100');
            }, 50);

            document.body.classList.add('overflow-hidden'); // Mencegah scroll saat modal terbuka
        }
        // menutup modal tambah diskon
        function closeModalTambahKategoriDiskon() {
            let modal = document.getElementById('modal-tambah-kategori-diskon');
            let overlay = document.getElementById('modal-overlay-tambah-kategori-diskon');

            // Tambahkan animasi keluar
            modal.classList.add('scale-95', 'opacity-0');
            modal.classList.remove('scale-100', 'opacity-100');

            // Tunggu animasi selesai sebelum menyembunyikan modal
            setTimeout(() => {
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300); // Sesuai dengan durasi transition (300ms)
        }


        // membuka modal edit diskon
        document.querySelectorAll('.btn-edit-kategori-diskon').forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-kategori-id');
                openModalEditKategoriDiskon(itemId);
            });
        });

        function openModalEditKategoriDiskon(id) {
            let overlay = document.getElementById('modal-overlay-edit-kategori-diskon');
            let modal = document.getElementById('modal-edit-kategori-diskon');

            // Bisa juga tambahkan logika untuk menampilkan data sesuai id

            overlay.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('scale-95', 'opacity-0');
                modal.classList.add('scale-100', 'opacity-100');
            }, 50);

            document.body.classList.add('overflow-hidden');
        }

        // menutup modal edit diskon
        function closeModalEditKategoriDiskon() {
            let modal = document.getElementById('modal-edit-kategori-diskon');
            let overlay = document.getElementById('modal-overlay-edit-kategori-diskon');

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
