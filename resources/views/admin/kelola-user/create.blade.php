<!-- resources/views/home.blade.php -->
@extends('layouts/admin')

@section('title', 'Tambah Data User')

@section('content')

    <div class="max-w-lg mx-auto px-8 py-5 bg-white rounded-lg shadow-lg border border-gray-400 md:border-none">
        <h1 class="text-lg md:text-xl font-semibold mb-6 pb-2 border-b text-center">Tambah Admin Baru</h1>

        <form id="userForm" action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div class="mb-4">
                    <label for="name" class="block font-medium text-gray-600">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="mt-2 w-full p-3 border rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:outline-none"
                        placeholder="Masukkan Nama Anda">
                </div>

                <div class="mb-4">
                    <label for="email" class="block font-medium text-gray-600">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="mt-2 w-full p-3 border rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:outline-none"
                        placeholder="Masukkan Email Anda">
                </div>

                <div class="mb-4">
                    <label for="no_telp" class="block font-medium text-gray-600">Nomor Telepon</label>
                    <input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp') }}"
                        class="mt-2 w-full p-3 border rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:outline-none"
                        placeholder="Masukkan Nomor Telepon Anda">
                </div>

                <div class="mb-4 relative">
                    <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                    <div class="relative flex items-center">
                        <input id="password" type="password" name="password"
                            class="mt-2 w-full p-3 pr-10 border rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:outline-none"
                            placeholder="Masukkan Password Anda">
                    </div>
                </div>

                <div class="mb-4 relative">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-600">
                        Konfirmasi Password
                    </label>
                    <div class="relative flex items-center">
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="mt-2 w-full p-3 pr-10 border rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:outline-none"
                            placeholder="Masukkan ulang password Anda">
                    </div>
                </div>

                <div class="flex space-x-3 justify-end mt-6">
                    <button type="button" id="cancelButton"
                        class="flex space-x-2 text-white bg-red-500 hover:bg-red-600 focus:bg-red-600 p-2 rounded-lg">
                        <p>Batalkan</p>
                    </button>
                    <button type="submit"
                        class="flex space-x-2 text-white bg-green-600 hover:bg-green-700 focus:bg-green-600 py-2 px-6 rounded-lg">
                        <p>Tambah</p>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- SweetAlert dan Validasi Form -->
    <script>
        document.getElementById('userForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman form secara langsung

            // Ambil nilai input
            let name = document.getElementById('name').value.trim();
            let email = document.getElementById('email').value.trim();
            let noTelp = document.getElementById('no_telp').value.trim();
            let password = document.getElementById('password').value.trim();
            let passwordConfirm = document.getElementById('password_confirmation').value.trim();

            // Validasi apakah ada input yang kosong
            if (!name || !email || !noTelp || !password || !passwordConfirm) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Harap isi semua kolom terlebih dahulu!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: false
                });
                return; // Hentikan proses jika ada input yang kosong
            }

            // Validasi password match
            if (password !== passwordConfirm) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Konfirmasi password harus sama dengan password!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: false
                });
                return; // Hentikan proses jika password tidak cocok
            }

            // Jika semua valid, tampilkan SweetAlert Toast sukses lalu submit form
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Admin berhasil ditambahkan!',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: false
            }).then(() => {
                document.getElementById('userForm').submit(); // Submit form setelah toast sukses
            });
        });

        document.getElementById('cancelButton').addEventListener('click', function() {
            Swal.fire({
                title: 'Yakin ingin membatalkan?',
                text: 'Perubahan tidak akan disimpan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('kelola-pelanggan') }}"; // Pastikan route sudah benar
                }
            });
        });
    </script>

@endsection
