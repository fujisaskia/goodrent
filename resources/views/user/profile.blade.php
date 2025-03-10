<!-- resources/views/home.blade.php -->
@extends('layouts/user')

@section('title', 'Akun Saya')

@section('content')

    <div class="max-w-4xl mx-auto p-8 bg-gradient-to-b bg-white rounded-lg shadow-lg border border-gray-400 md:border-none">
        <h1 class="text-xl font-semibold mb-6 pb-2 border-b text-center">Akun Saya</h1>
        <form action="{{ route('edit.profil') }}" method="POST">
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
                            <button type="button" onclick="togglePassword('password')"
                                class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                                <svg id="eyeIconConfirm" xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 pointer-events-none" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                    <img src="{{ asset('assets/profile.jpg') }}" alt="Foto Profile"
                        class="w-48 h-48 border border-gray-300 p-2 rounded-full object-cover">
                    <input type="file" name="image" class="w-2/3 mt-4 text-sm border p-1" accept="image/*">
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
        function togglePassword(id) {
            let input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>

@endsection
