@extends('layouts/admin')

@section('title', 'Data Barang')

@section('content')

    <div class="mx-auto p-2">
        <h2 class="flex space-x-3 text-3xl font-bold mb-4 items-center justify-center md:justify-start">
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
                    <a href="/admin/tambah-data-barang" class="bg-green-600 text-white p-3 rounded-lg flex items-center gap-2 focus:scale-95 duration-300">
                            <span class=""><i class="fa-solid fa-plus"></i> Tambah Barang</span>
                    </a>
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
                                <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="" class="w-16 h-auto">
                            </td>
                            <td class="p-3">-</td>
                            <td class="p-3">RP 50,000 / jam</td>
                            <td class="p-3 flex items-center justify-center gap-2">
                                {{-- button lihat --}}
                                <a href="">
                                    @include('components.crud.read')
                                </a>
                                
                                {{-- button edit --}}
                                <a href="/admin/edit-data-barang">
                                    @include('components.crud.edit')
                                </a>

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
                                <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="" class="w-16 h-auto">
                            </td>
                            <td class="p-3">-</td>
                            <td class="p-3">RP 50,000 / jam</td>
                            <td class="p-3 flex items-center justify-center gap-2">
                                {{-- button lihat --}}
                                <a href="">
                                    @include('components.crud.read')
                                </a>
                                
                                {{-- button edit --}}
                                <a href="">
                                    @include('components.crud.edit')
                                </a>

                                {{-- button hapus --}}
                                <form action="" id="delete-form">
                                    @include('components.crud.delete')
                                </form>
                            </td>
                        </tr>
                        <tr class="border-b text-center hover:bg-gray-50">
                            <td class="p-3 ">3</td>
                            <td class="p-3">Lorem ipsum dolor sit amet.</td>
                            <td class="flex justify-center p-3">
                                <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg" alt="" class="w-16 h-auto">
                            </td>
                            <td class="p-3">-</td>
                            <td class="p-3">RP 50,000 / jam</td>
                            <td class="p-3 flex items-center justify-center gap-2">
                                {{-- button lihat --}}
                                <a href="">
                                    @include('components.crud.read')
                                </a>
                                
                                {{-- button edit --}}
                                <a href="">
                                    @include('components.crud.edit')
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
                        this.closest('form').submit(); // Ambil form terdekat dari tombol yang diklik
                    }
                });
            });
        });
    </script>
        

@endsection
