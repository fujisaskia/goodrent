<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Daftar Akun GoodRent</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Data AOS Animate --}}
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Font Awesome CDN Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="flex justify-center items-center min-h-screen bg-gradient-to-r from-yellow-100 to-emerald-50 py-12 px-6 md:text-sm">
    <div data-aos="fade-up" data-aos-duration="800" class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <!-- Title -->
        <div class="text-center text-xl font-bold mb-6 text-gray-800">
            <span class="mb-1">- Daftar Akun -</span>
            <h2 class="text-4xl text-emerald-700 font-semibold">
                <span class="">GoodRent</span>
            </h2>
        </div>

        <!-- Form Input -->
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-600">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="mt-2 w-full p-3 border rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:outline-none 
                    @error('name') border-red-500 ring-1 ring-red-500 @enderror"
                    placeholder="Masukkan Nama Anda">
                @error('name')
                    <span class="text-sm text-red-700">*{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block font-medium text-gray-600">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="mt-2 w-full p-3 border rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:outline-none 
                    @error('email') border-red-500 ring-1 ring-red-500 @enderror"
                    placeholder="Masukkan Email Anda">
                @error('email')
                    <span class="text-sm text-red-700">*{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="no_telp" class="block font-medium text-gray-600">Nomor Telepon</label>
                <input type="text" name="no_telp" value="{{ old('no_telp') }}"
                    class="mt-2 w-full p-3 border rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:outline-none 
                    @error('no_telp') border-red-500 ring-1 ring-red-500 @enderror"
                    placeholder="Masukkan Nomor Telepon Anda">
                @error('no_telp')
                    <span class="text-sm text-red-700">*{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4 relative">
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>

                <div class="relative flex items-center">
                    <input id="password" type="password" name="password"
                        class="mt-2 w-full p-3 pr-10 border rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:outline-none 
                        @error('password') border-red-500 ring-1 ring-red-500 @enderror"
                        placeholder="Masukkan Password Anda">
                    <button type="button" id="togglePassword"
                        class="absolute inset-y-0 right-3 pt-2 flex items-center justify-center text-gray-500">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 pointer-events-none"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </button>
                </div>

                @error('password')
                    <span class="text-sm text-red-700">*{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4 relative">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-600">
                    Konfirmasi Password
                </label>

                <div class="relative flex items-center">
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="mt-2 w-full p-3 pr-10 border rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:outline-none 
                        @error('password_confirmation') border-red-500 ring-1 ring-red-500 @enderror"
                        placeholder="Masukkan ulang password Anda">
                    <button type="button" id="toggleConfirmPassword"
                        class="absolute inset-y-0 right-3 pt-2 flex items-center text-gray-500">
                        <svg id="eyeIconConfirm" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 pointer-events-none"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </button>
                </div>

                @error('password_confirmation')
                    <span class="text-sm text-red-700">*{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 transition-all duration-300 p-3 text-white font-bold rounded-lg">
                    Daftar
                </button>
            </div>
        </form>

        <h4 class="text-sm text-center mt-6">Sudah memiliki akun? <a href="/login"
                class="text-blue-600 hover:text-blue-700 font-semibold underline hover:translate-x-2">Masuk di sini!</a>
        </h4>
    </div>

    <!-- Include AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Initialize AOS -->
    <script>
        AOS.init();
    </script>
</body>

</html>
