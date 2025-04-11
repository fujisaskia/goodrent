<!-- resources/views/home.blade.php -->
@extends('layouts/admin')

@section('title', 'Kelola Diskon')

@section('content')

    <div class="mx-auto p-2">
        <h2 class="flex space-x-3 text-3xl font-bold mb-4 items-center  justify-center md:justify-start ">
            <i class="fa-solid fa-percent text-emerald-800"></i>
            <span>Kelola Diskon</span>
        </h2>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row justify-between mb-4">
                <div class="flex space-x-4 mb-2 md:mb-0">
                    <input type="search" placeholder="Cari Diskon"
                        class="border p-3 rounded-lg w-60 focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                    <button class="py-3 px-4 bg-emerald-600 rounded-full text-white focus:scale-95 duration-300">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                <div class="flex justify-end">
                    <button onclick="openModalTambahDiskon()"
                        class="bg-green-700 hover:bg-green-800 flex space-x-2 text-white p-3 rounded-lg items-center focus:scale-95 duration-300">
                        <i class="fa-solid fa-plus"></i>
                        <span>Tambah Diskon</span>
                    </button>
                </div>

                {{-- Modal Tambah Data Barang  --}}
                @include('admin.diskon.create')
            </div>

            <div class="overflow-x-auto lg:overflow-visible">
                <table class="w-full border-collapse border rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-500 text-white uppercase">
                            <th class="p-3">no</th>
                            <th class="p-3">nama diskon</th>
                            <th class="p-3">kode diskon</th>
                            <th class="p-3">jenis diskon</th>
                            <th class="p-3">besar diskon</th>
                            <th class="p-3">masa berlaku</th>
                            <th class="p-3">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3  text-center">1</td>
                            <td class="p-3  text-center">New Member</td>
                            <td class="p-3  text-center uppercase">midnight25</td>
                            <td class="p-3  text-center">persentase</td>
                            <td class="p-3  text-center">50%</td>
                            <td class="p-3  text-center">01 Mei 2025 -15 Mei 2025</td>
                            <td class="p-3 flex justify-center gap-2">
                                {{-- button edit --}}
                                <button
                                    class="btn-edit-diskon bg-yellow-500 hover:bg-yellow-600 shadow-md shadow-yellow-300 hover:shadow-none focus:scale-95 duration-300 
                                        text-white py-2 px-2.5 rounded-full"
                                    title="Edit Diskon" data-diskon-id="">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                {{-- Modal Tambah Data Barang  --}}
                                @include('admin.diskon.edit')

                                {{-- button hapus --}}
                                <form action="" id="delete-form">
                                    @include('components.crud.delete')
                                </form>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3  text-center">2</td>
                            <td class="p-3  text-center">New Member</td>
                            <td class="p-3  text-center uppercase">midnight25</td>
                            <td class="p-3  text-center">persentase</td>
                            <td class="p-3  text-center">50%</td>
                            <td class="p-3  text-center">01 Mei 2025 -15 Mei 2025</td>
                            <td class="p-3 flex justify-center gap-2">
                                {{-- button edit --}}
                                <button
                                    class="btn-edit-diskon bg-yellow-500 hover:bg-yellow-600 shadow-md shadow-yellow-300 hover:shadow-none focus:scale-95 duration-300 
                                        text-white py-2 px-2.5 rounded-full"
                                    title="Edit Diskon" data-diskon-id="">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                {{-- Modal Tambah Data Barang  --}}
                                @include('admin.diskon.edit')

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
                    title: "Hapus Diskon?",
                    text: "Diskon yang dihapus tidak bisa dikembalikan!",
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
        function openModalTambahDiskon() {
            let overlay = document.getElementById('modal-overlay-tambah-diskon');
            let modal = document.getElementById('modal-tambah-diskon');

            // Tampilkan overlay
            overlay.classList.remove('hidden');

            // Beri jeda untuk animasi
            setTimeout(() => {
                modal.classList.remove('scale-95', 'opacity-0');
                modal.classList.add('scale-100', 'opacity-100');
            }, 50);

            document.body.classList.add('overflow-hidden'); // Mencegah scroll saat modal terbuka
        }

        function closeModalTambahDiskon() {
            let modal = document.getElementById('modal-tambah-diskon');
            let overlay = document.getElementById('modal-overlay-tambah-diskon');

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
        document.querySelectorAll('.btn-edit-diskon').forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-diskon-id');
                openModalEditDiskon(itemId);
            });
        });

        // membuka modal edit diskon
        function openModalEditDiskon(id) {
            let overlay = document.getElementById('modal-overlay-edit-diskon');
            let modal = document.getElementById('modal-edit-diskon');

            // Tampilkan overlay
            overlay.classList.remove('hidden');

            // Beri jeda untuk animasi
            setTimeout(() => {
                modal.classList.remove('scale-95', 'opacity-0');
                modal.classList.add('scale-100', 'opacity-100');
            }, 50);

            document.body.classList.add('overflow-hidden'); // Mencegah scroll saat modal terbuka
        }

        function closeModalEditDiskon() {
            let modal = document.getElementById('modal-edit-diskon');
            let overlay = document.getElementById('modal-overlay-edit-diskon');

            // tambahkan animasi keluar
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
