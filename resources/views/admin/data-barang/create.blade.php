<!-- resources/views/home.blade.php -->
@extends('layouts/admin')

@section('title', 'Tambah Data Barang')

@section('content')

    <div class="max-w-lg mx-auto p-8 bg-white rounded-lg shadow-lg border border-gray-400 md:border-none">
        <h1 class="text-lg md:text-xl font-semibold mb-6 pb-2 border-b text-center">Tambah Barang Baru</h1>

        <form action="" method="POST">
            @csrf
            <div class="space-y-4">
                <div class="">
                    <label for="" class="block text-gray-700 mb-2">Jenis PS</label>
                    <input type="text" name="" placeholder="silahkan isi jenis barang"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>

                <div class="">
                    <label for="" class="block text-gray-700 mb-2">Deskripsi Barang</label>
                    <textarea name="" placeholder="silahkan isi deskripsi"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                     rows="3" required></textarea>
                </div>

                <div class="">
                    <label for="" class="block text-gray-700 mb-2">Harga</label>
                    <input type="number" name="" placeholder="silahkan isi harga"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>

                <div class="">
                    <label for="photos" class="block font-medium text-gray-700">Foto Barang</label>
                    <input type="file" id="photos" name="photos[]" multiple accept="image/*"
                        class="mt-1 block w-full p-2 border rounded">
                </div>
            </div>

            <div class="flex space-x-3 justify-end mt-6">
                <a href=""
                    class="flex space-x-2 text-white bg-red-500 hover:bg-red-600 focus:bg-red-600 p-2 rounded-lg">
                    <p>Batalkan</p>
                </a>
                <button type="submit"
                    class="flex space-x-2 text-white bg-green-600 hover:bg-green-700 focus:bg-green-600 p-2 rounded-lg">
                    <i class="fa-solid fa-plus"></i>
                    <p>Tambah Barang</p>
                </button>
            </div>
        </form>


    </div>



@endsection
