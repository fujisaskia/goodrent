@extends('layouts/user')

@section('title', 'Alamat Saya')

@section('content')

    <div class="max-w-4xl mx-auto p-8 bg-gradient-to-b bg-white rounded-lg shadow-lg border border-gray-400 md:border-none">
        <div class="flex justify-between pb-2 mb-5 border-b border-gray-300">
            <h3 class="text-xl font-bold">Alamat Saya</h3>
            <a href="/goodrent/profile/tambah-alamat" class="bg-emerald-700 hover:bg-emerald-800 rounded p-1.5 text-white text-xs">
                <span>Tambah Alamat</span>
            </a>
        </div>

        <div class="flex flex-col md:flex-row justify-between border border-gray-300 p-2">
            <div class="text-sm space-y-2 mb-3 md:mb-0">
                <h4 class="font-semibold">SMKN 1 CIOMAS</h4>
                <p class="text-xs">SMK Negeri 1 Ciomas, Jl. Raya Laladon, Laladon, Kec. Ciomas, Kabupaten Bogor, Jawa Barat 16610</p>
            </div>

            <div class="flex space-x-2 text-xs font-semibold">
                <a href="" class="text-yellow-700 px-3 py-1 hover:underline">Ubah</a>
                <a href="" class="text-red-700 px-3 py-1 hover:underline">Hapus</a>
            </div>
            
        </div>

    </div>

@endsection
