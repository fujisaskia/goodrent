<!-- resources/views/home.blade.php -->
@extends('layouts/admin')

@section('title', 'Kelola Pelanggan')

@section('content')

    <div class="mx-auto p-2">
        <h2 class="flex space-x-3 text-2xl md:text-3xl font-bold mb-4 items-center justify-center md:justify-start">
            <x-iconsax-bol-profile-2user class="w-8 h-auto text-emerald-800" />
            <span>Kelola Pelanggan</span>
        </h2>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <!-- Wrapper untuk Modal dan Tombol Tambah Admin -->
            <div>
                <div class="flex flex-col md:flex-row justify-between mb-4">
                    <!-- Input Pencarian -->
                    <div class="flex space-x-4 mb-2 md:mb-0">
                        <input type="search" placeholder="Cari Pengguna"
                            class="w-full border p-3 rounded-lg w-60 focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                        <button class="py-3 px-4 bg-emerald-600 rounded-full text-white focus:scale-95 duration-300">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>

                    <!-- Tombol Tambah Admin -->
                    @if (auth()->user()->hasRole('superadmin'))
                        <div class="flex justify-end w-full md:w-auto">
                            <button onclick="openModalTambahAdmin()"
                                class="bg-green-700 hover:bg-green-800 flex space-x-2 text-white p-3 rounded-lg items-center focus:scale-95 duration-300">
                                <i class="fa-solid fa-plus"></i> 
                                <span>Tambah Admin</span>
                            </button>
                        </div>
                    @endif
                    @include('admin.kelola-user.create')
                </div>

            </div>

            <div class="overflow-x-auto lg:overflow-visible">
                <table class="w-full border-collapse border rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-500 text-white uppercase">
                            <th class="p-3">No</th>
                            <th class="p-3">Foto</th>
                            <th class="p-3">Nama Pengguna</th>
                            <th class="p-3 text-center">No. Telp</th>
                            <th class="p-3 text-center">Status</th>
                            <th class="p-3 text-center">Terakhir Online</th>
                            <th class="p-3 text-center">Status Pelanggan</th>
                            <th class="p-3 text-center">Batasi</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index=>$user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 text-center">{{ $index + 1 }}</td>
                                <td class="p-3 text-center">
                                    <img src="{{ asset('storage/users/' . $user->image) }}"
                                        class="w-10 h-10 object-cover rounded-full text-cen">
                                </td>
                                <td class="p-3">{{ $user->name }}</td>
                                <td class="p-3 text-center">{{ $user->no_telp }}</td>
                                <td class="p-3 text-center">{{ $user->status }}</td>
                                <td class="p-3 text-center">
                                    {{ $user->status === 'Offline' ? \Carbon\Carbon::parse($user->last_online_at)->diffForHumans() : '' }}
                                </td>
                                <td class="p-3 text-center">{{ $user->status_pelanggan }}</td>

                                {{-- Kolom Batasi --}}
                                <td class="p-3 text-center">
                                    <div class="inline-flex space-x-4">
                                        @if ($user->status_pelanggan === 'Suspended')
                                            {{-- Tombol Unsuspend --}}
                                            <form action="{{ route('pelanggan.un-suspend', $user->id) }}" method="POST">
                                                @csrf
                                                @include('components.crud.unsuspend')
                                            </form>
                                        @else
                                            {{-- Tombol Suspend --}}
                                            <form action="{{ route('pelanggan.suspend', $user->id) }}" method="POST">
                                                @csrf
                                                @include('components.crud.suspend')
                                            </form>
                                        @endif

                                        @if ($user->status_pelanggan === 'Banned')
                                            <button
                                                class="bg-gray-500 text-white p-2 rounded-full shadow-md shadow-gray-300 cursor-not-allowed opacity-50"
                                                title="Telah diblokir" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>
                                            </button>
                                        @else
                                            {{-- Tombol Banned --}}
                                            <form action="{{ route('pelanggan.banned', $user->id) }}" method="POST">
                                                @csrf
                                                @include('components.crud.banned')
                                            </form>
                                        @endif
                                    </div>
                                </td>


                                {{-- Kolom Aksi --}}
                                <td class="p-3 text-center">
                                    <div class="inline-flex space-x-4">
                                        <a href="">
                                            @include('components.crud.read')
                                        </a>
                                        @if (isset($user) && $user->id)
                                            <form id="delete-form-{{ $user->id }}" method="POST"
                                                action="{{ route('kelola-pelanggan.destroy', $user->id) }}">
                                                @csrf
                                                @method('DELETE')

                                                <!-- Tombol Hapus -->
                                                <button type="button"
                                                    class="delete-btn bg-red-500 hover:bg-red-600 shadow-md shadow-red-400 hover:shadow-none focus:scale-95 duration-300 text-white p-2 rounded-full"
                                                    data-form-id="delete-form-{{ $user->id }}"
                                                    data-role="{{ $user->roles->first()->name ?? 'pelanggan' }}"
                                                    class="" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-5 md:size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif

                                </td>
                            </tr>
                        @empty
                            <tr class="border-b hover:bg-gray-50">
                                <td rowspan="7" class="p-6 text-center">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                let formId = this.getAttribute('data-form-id');
                let userRole = this.getAttribute('data-role') || 'pelanggan';

                let titleText = userRole === 'admin' ? "Hapus Admin?" : "Hapus Pelanggan?";
                let descriptionText = userRole === 'admin' ?
                    "Admin yang dihapus tidak bisa dikembalikan!" :
                    "Pelanggan yang dihapus tidak bisa dikembalikan!";

                Swal.fire({
                    title: titleText,
                    text: descriptionText,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#9ca3af",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal",
                    customClass: {
                        confirmButton: 'rounded-full px-4 py-2',
                        cancelButton: 'rounded-full px-4 py-2'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Menghapus...",
                            text: "Harap tunggu sebentar.",
                            icon: "info",
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        setTimeout(() => {
                            let form = document.getElementById(formId);
                            if (form) {
                                form.submit();
                            } else {
                                Swal.fire("Error", "Form tidak ditemukan!", "error");
                            }
                        }, 1500);
                    }
                });
            });
        });


        // membuka modal tambah user
        function openModalTambahAdmin() {
            let overlay = document.getElementById('modal-overlay');
            let modal = document.getElementById('modal');

            // Tampilkan overlay
            overlay.classList.remove('hidden');

            // Beri jeda untuk animasi
            setTimeout(() => {
                modal.classList.remove('scale-95', 'opacity-0');
                modal.classList.add('scale-100', 'opacity-100');
            }, 50);

            document.body.classList.add('overflow-hidden'); // Mencegah scroll saat modal terbuka
        }

        function closeModalTambahAdmin() {
            let modal = document.getElementById('modal');
            let overlay = document.getElementById('modal-overlay');

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
