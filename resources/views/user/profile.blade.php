<!-- resources/views/home.blade.php -->
@extends('layouts/user')

@section('title', 'Akun Saya')

@section('content')

    <div class="max-w-4xl mx-auto p-8 bg-gradient-to-b bg-white rounded-lg shadow-lg border border-gray-400 md:border-none">
        <h1 class="text-xl font-semibold mb-6 pb-2 border-b text-center">Akun Saya</h1>
        <form action="">
            @csrf
            <div class="flex flex-col lg:flex-row space-x-6">
                <div class="flex-1 space-y-4 bg-white rounded-r-2xl order-2 lg:order-1">
                    <div class="">
                        <label for="name" class="text-gray-600 mb-1 px-1">Nama</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}"
                            class="w-full border border-gray-200 rounded-md p-3 focus:outline-none focus:ring focus:ring-yellow-50">
                    </div>
                    <div class="">
                        <label for="email" class="text-gray-600 mb-1 px-1">Email</label>
                        <input type="text" name="email" value="{{ Auth::user()->email }}"
                            class="w-full border border-gray-200 rounded-md p-3 focus:outline-none focus:ring focus:ring-yellow-50">
                    </div>
                    <div class="">
                        <label for="no_telp" class="text-gray-600 mb-1 px-1">No Telepon</label>
                        <input type="number" name="no_telp" value="{{ Auth::user()->no_telp }}"
                            class="w-full border border-gray-200 rounded-md p-3 focus:outline-none focus:ring focus:ring-yellow-50">
                    </div>
                </div>
                <div class="flex flex-col p-6 order-1 lg:order-2 items-center justify-center">
                    <img src="{{ asset('assets/profile.jpg') }}" alt="Foto Profile"
                        class="w-48 h-48 border border-gray-300 p-2 rounded-full object-cover">
                    <input type="file" name="image" class="w-2/3 mt-4 text-sm border p-1" accept="image/*" placeholder="ubah foto profile">
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



@endsection
