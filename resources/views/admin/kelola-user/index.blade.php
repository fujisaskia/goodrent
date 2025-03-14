<!-- resources/views/home.blade.php -->
@extends('layouts/admin')

@section('title', 'Kelola Pelanggan')

@section('content')

    <div class="mx-auto p-2">
        <h2 class="flex space-x-3 text-3xl font-bold mb-4 items-center justify-center md:justify-start">
            <x-iconsax-bol-profile-2user class="w-8 h-auto text-emerald-800" />
            <span>Kelola Pelanggan</span>
        </h2>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row justify-between mb-4">
                <div class="flex space-x-4 mb-2 md:mb-0">
                    <input type="search" placeholder="Cari Pengguna"
                        class="w-full border p-3 rounded-lg w-60 focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                    <button class="py-3 px-4 bg-emerald-600 rounded-full text-white focus:scale-95 duration-300">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                @if (auth()->user()->hasRole('superadmin'))
                    <div class="flex justify-end">
                        <a href="{{ route('tambah-admin') }}">
                            <button
                                class="bg-green-600 text-white p-3 rounded-lg flex items-center gap-2 focus:scale-95 duration-300">
                                <span><i class="fa-solid fa-plus"></i> Tambah Admin</span>
                            </button>
                        </a>
                    </div>
                @endif
            </div>

            <div class="overflow-x-auto lg:overflow-visible">
                <table class="w-full border-collapse border rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-500 text-white uppercase">
                            <th class="p-3">No</th>
                            <th class="p-3 text-center">Foto Profil</th>
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

                                        {{-- Tombol Banned --}}
                                        <form action="{{ route('pelanggan.banned', $user->id) }}" method="POST">
                                            @include('components.crud.banned')
                                        </form>
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
                                                action="{{ route('kelola-pelanggan.destroy', $user->id) }}"
                                                data-role="{{ $user->roles->first()->name ?? 'pelanggan' }}">
                                                @csrf
                                                @method('DELETE')
                                                @include('components.crud.delete')
                                            </form>
                                        @endif
                                    </div>
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
        document.querySelectorAll('#delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                let formId = this.getAttribute('data-form-id'); // Ambil ID form
                let userRole = this.getAttribute('data-role') ||
                'pelanggan'; // Default ke pelanggan jika role tidak ada

                // Tentukan pesan berdasarkan role
                let titleText = (userRole === 'admin') ? "Hapus Admin?" : "Hapus Pelanggan?";
                let descriptionText = (userRole === 'admin') ?
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
                                Swal.showLoading(); // Efek loading
                            }
                        });

                        setTimeout(() => {
                            this.closest('form').submit(); // Submit form setelah animasi
                        }, 1500);
                    }
                });
            });
        });
    </script>

@endsection
