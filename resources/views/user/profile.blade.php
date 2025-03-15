<!-- resources/views/home.blade.php -->
@extends('layouts/user')

@section('title', 'Akun Saya')

@section('content')

    <div class="max-w-4xl mx-auto p-8 bg-gradient-to-b bg-white rounded-lg shadow-lg border border-gray-400 md:border-none">
        <h1 class="text-xl font-semibold mb-6 pb-2 border-b text-center">Akun Saya</h1>
        <form action="{{ route('edit.profil') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col lg:flex-row space-x-6">
                <div class="flex-1 space-y-4 bg-white rounded-r-2xl order-2 lg:order-1">
                    <div>
                        <label for="name" class="text-gray-600 mb-1 px-1">Nama</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}"
                            class="w-full border border-gray-200 rounded-md p-3 focus:outline-none focus:ring focus:ring-yellow-50">
                        @error('name')
                            <span class="text-sm p-1 text-red-700">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="text-gray-600 mb-1 px-1">Email</label>
                        <input type="text" name="email" value="{{ Auth::user()->email }}"
                            class="w-full border border-gray-200 rounded-md p-3 focus:outline-none focus:ring focus:ring-yellow-50">
                        @error('email')
                            <span class="text-sm p-1 text-red-700">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="no_telp" class="text-gray-600 mb-1 px-1">No Telepon</label>
                        <input type="number" name="no_telp" value="{{ Auth::user()->no_telp }}"
                            class="w-full border border-gray-200 rounded-md p-3 focus:outline-none focus:ring focus:ring-yellow-50">
                        @error('no_telp')
                            <span class="text-sm p-1 text-red-700">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="text-gray-600 mb-1 px-1">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="w-full border border-gray-200 rounded-md p-3 focus:outline-none focus:ring focus:ring-yellow-50">
                            <button type="button" id="togglePassword"
                                class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 pointer-events-none"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-sm p-1 text-red-700">*{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col p-6 order-1 lg:order-2 items-center justify-center">
                    <img id="profileImage" src="{{ asset('storage/users/' . (Auth::user()->image ?: 'Dummy.png')) }}"
                        alt="Foto Profile" class="w-60 h-60">

                    <!-- Input Gambar -->
                    <input type="file" name="image" id="imageInput" class="w-2/3 mt-4 text-sm border p-1"
                        accept="image/*">
                </div>
            </div>

            <div class="flex space-x-3 justify-end mt-12">
                <button type="submit"
                    class="flex space-x-2 text-white bg-yellow-500 hover:bg-yellow-600 focus:bg-yellow-600 px-6 py-3 rounded-lg">
                    <p>Simpan</p>
                </button>
            </div>
        </form>


    </div>

    <script>
        function togglePasswordVisibility(passwordFieldId, iconId) {
            const password = document.getElementById(passwordFieldId);
            const eyeIcon = document.getElementById(iconId);

            // Toggle tipe input
            const isPassword = passwordInput.type === "password";
            passwordInput.type = isPassword ? "text" : "password";

            // Ganti ikon mata sesuai status
            eyeIcon.innerHTML = isPassword ?
                '<path d="M17.94 17.94A10.42 10.42 0 0 1 12 20c-7 0-11-8-11-8a18.16 18.16 0 0 1 3.66-4.88m3.92-2.52A10.31 10.31 0 0 1 12 4c7 0 11 8 11 8a18.16 18.16 0 0 1-3.66 4.88"/><path d="M1 1l22 22"/>' :
                '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
        }

        // Event listener untuk password utama
        document.getElementById("togglePassword").addEventListener("click", function() {
            togglePasswordVisibility("password", "eyeIcon");
        });

        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

@endsection
