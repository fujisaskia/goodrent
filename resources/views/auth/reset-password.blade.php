<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reset Password GoodRent</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo-fixed.png') }}">

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

<body class="flex justify-center items-center min-h-screen bg-gradient-to-r from-emerald-100 to-yellow-50 px-6">
    <div data-aos="zoom-in" data-aos-duration="800" class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <!-- Title -->
        <!-- Title -->
        <div class="text-center text-xl font-bold mb-4 text-gray-800">
            <h3 class="mb-2">Buat Password Baru</h3>
            {{-- <div class="text-xs bg-blue-100 border border-blue-300 p-2 text-left rounded">Masukkan email Anda yang terdaftar di bawah ini, kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.</div> --}}
        </div>

        <!-- Form Input -->
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-4 relative">
                <label for="password" class="block text-sm font-medium text-gray-600">Password Baru</label>
                <input id="password" type="password" name="password"
                    class="mt-2 w-full p-3 border rounded-lg focus:border-yellow-600 focus:ring-1 focus:ring-yellow-600 focus:outline-none 
                        @error('password') border-red-500 ring-1 ring-red-500 @enderror"
                    placeholder="Masukkan password baru anda">

                <!-- Icon Mata -->
                <button type="button" id="togglePassword"
                    class="absolute top-2/3 right-3 -translate-y-1/2 flex items-center text-gray-500">
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
                @error('password')
                    <span class="text-sm p-1 text-red-700">*{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4 relative">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Konfirmasi Password
                    Baru</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="mt-2 w-full p-3 border rounded-lg focus:border-yellow-600 focus:ring-1 focus:ring-yellow-600 focus:outline-none 
                        @error('password_confirmation') border-red-500 ring-1 ring-red-500 @enderror"
                    placeholder="Masukkan ulang password baru anda">

                <!-- Icon Mata -->
                <button type="button" id="toggleConfirmPassword"
                    class="absolute top-2/3 right-3 -translate-y-1/2 flex items-center text-gray-500">
                    <svg id="eyeIconConfirm" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
                @error('password_confirmation')
                    <span class="text-sm p-1 text-red-700">*{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-5">
                <button type="submit"
                    class="w-full bg-yellow-800 hover:bg-yellow-900 transition-all duration-300 p-3 text-white font-bold rounded-lg">
                    Simpan
                </button>
            </div>
        </form>

    </div>

    <!-- Include AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Initialize AOS -->
    <script>
        AOS.init();
    </script>
</body>

</html>
