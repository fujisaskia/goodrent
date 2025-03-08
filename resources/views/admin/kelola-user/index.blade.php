<!-- resources/views/home.blade.php -->
@extends('layouts/admin')

@section('title', 'Kelola User')

@section('content')

    <div class="mx-auto p-2">
        <h2 class="flex space-x-3 text-3xl font-bold mb-4 items-center justify-center md:justify-start">
            <x-iconsax-bol-profile-2user class="w-8 h-auto text-emerald-800" />
            <span>Kelola User</span>
        </h2>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row justify-between mb-4">
                <div class="flex space-x-4 mb-2 md:mb-0">
                    <input type="search" placeholder="Cari Pengguna"
                        class="border p-3 rounded-lg w-60 focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                    <button class="py-3 px-4 bg-emerald-600 rounded-full text-white focus:scale-95 duration-300">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                <a href="/admin/tambah-user">
                    <button class="bg-green-600 text-white p-3 rounded-lg flex items-center gap-2 focus:scale-95 duration-300">
                        <span class=""><i class="fa-solid fa-plus"></i> Tambah User</span>
                    </button>
                </a>
            </div>

            <div class="overflow-x-auto lg:overflow-visible">
                <table class="w-full border-collapse border rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-500 text-white uppercase">
                            <th class="p-3">no</th>
                            <th class="p-3">nama pengguna</th>
                            {{-- <th class="p-3">hak akses</th> --}}
                            <th class="p-3">e-mail</th>
                            <th class="p-3">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3  text-center">1</td>
                            <td class="p-3">Hilal Ahmad Mujaddid</td>
                            <td class="p-3">hilal123@gmail.com</td>
                            <td class="p-3 flex justify-center gap-2">
                                {{-- button lihat --}}
                                <a href="">
                                    @include('components.crud.read')
                                </a>

                                {{-- button hapus --}}
                                <form action="" id="delete-form">
                                    @include('components.crud.delete')
                                </form>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3  text-center">2</td>
                            <td class="p-3">Fitri Amaliah</td>
                            <td class="p-3">fitri123@gmail.com</td>
                            <td class="p-3 flex justify-center gap-2">
                                {{-- button lihat --}}
                                <a href="">
                                    @include('components.crud.read')
                                </a>

                                {{-- button hapus --}}
                                <form action="" id="delete-form">
                                    @include('components.crud.delete')
                                </form>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3  text-center">3</td>
                            <td class="p-3">Fuji Saskia</td>
                            <td class="p-3">fuji123@gmail.com</td>
                            <td class="p-3 flex justify-center gap-2">
                                {{-- button lihat --}}
                                <a href="">
                                    @include('components.crud.read')
                                </a>

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
            button.addEventListener('click', function () {
                Swal.fire({
                    title: "Hapus User?",
                    text: "User yang dihapus tidak bisa dikembalikan!",
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
                        this.closest('form').submit(); // Ambil form terdekat dari tombol yang diklik
                    }
                });
            });
        });
    </script>

@endsection
