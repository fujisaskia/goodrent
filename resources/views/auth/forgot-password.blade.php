<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lupa Password GoodRent</title>

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

<body class="flex justify-center items-center min-h-screen bg-gradient-to-b from-slate-300 to-slate-100 px-6">
    <div data-aos="zoom-in" data-aos-duration="800" class="w-full max-w-md bg-white border border-gray-300 rounded-2xl shadow-xl p-8">
        <!-- Title -->
        <div class="text-center text-xl font-bold mb-4 text-gray-800">
            <h3 class="mb-2">Lupa Password Anda?</h3>
            <div class="text-xs bg-blue-100 border border-blue-300 p-2 text-left rounded">Masukkan email Anda yang terdaftar di bawah ini, kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.</div>
        </div>

        <!-- Form Input -->
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" name="email"
                    class="mt-2 w-full p-3 border border-gray-300 rounded-lg focus:border-gray-500 focus:ring-1 focus:ring-gray-500 focus:outline-none"
                    placeholder="Masukkan Email Anda">
                    @error('email')
                        <span class="text-sm p-1 text-red-700">*{{ $message }}</span>
                    @enderror
            </div>            

            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-800 hover:bg-blue-900 transition-all duration-300 p-3 text-white font-bold rounded-lg">
                    Kirim Pesan Email
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
