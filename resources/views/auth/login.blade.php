<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Masuk Akun GoodRent</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo-fixed.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Data AOS Animate --}}
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Font Awesome CDN Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex justify-center items-center min-h-screen bg-gradient-to-r from-emerald-100 to-yellow-50 px-6">
    <div data-aos="zoom-in" data-aos-duration="800" class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <!-- Title -->
        <div class="text-center text-xl font-bold mb-6 text-gray-800">
            <span class="mb-1">Masuk Akun</span>
            <h2 class="text-4xl text-emerald-700 font-semibold">
                <span class="">GoodRent</span>
            </h2>
        </div>

        <!-- Form Input -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" name="email" id="email"
                    class="mt-2 w-full p-3 border rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:outline-none 
                    @error('email') border-red-500 ring-1 ring-red-500 @enderror"
                    placeholder="Masukkan Email Anda">
                @error('email')
                    <span class="text-sm p-1 text-red-700">*{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col mb-4 relative">
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input id="password" type="password" name="password"
                    class="mt-2 w-full p-3 pr-10 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:outline-none
                    @error('password') border-red-500 ring-1 ring-red-500 @enderror"
                    placeholder="Masukkan Password Anda">
                @error('password')
                    <span class="text-sm p-1 text-red-700">*{{ $message }}</span>
                @enderror

                <a href="{{ route('forgot.password') }}"
                    class="text-sm mt-2 text-blue-600 hover:text-blue-700 font-semibold hover:translate-x-1 duration-200">
                    Lupa password?
                </a>

                <button type="button" id="togglePassword"
                    class="absolute top-2/4 right-3 -translate-y-1/2 flex items-center text-gray-500">
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 pointer-events-none"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </div>

            <div class="mt-5">
                <button type="submit"
                    class="w-full bg-gray-800 hover:bg-gray-900 transition-all duration-300 p-3 text-white font-bold rounded-lg">
                    Masuk
                </button>
            </div>
        </form>

        <h4 class="text-sm text-center mt-6">
            Belum memiliki akun?
            <a href="{{ route('register') }}"
                class="text-blue-600 hover:text-blue-700 font-semibold hover:translate-x-2">
                Daftar di sini!
            </a>
        </h4>
    </div>

    <!-- Include AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "success",
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "error",
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: false
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "error",
                title: "Oops! Ada kesalahan.",
                html: `{!! implode('<br>', $errors->all()) !!}`,
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: false
            });
        </script>
    @endif

    <!-- Initialize AOS -->
    <script>
        AOS.init();
    </script>
</body>

</html>
