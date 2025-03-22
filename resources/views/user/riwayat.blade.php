<!-- resources/views/home.blade.php -->
@extends('layouts/user')

@section('title', 'Pemesanan Saya')

@section('content')

<div class="max-w-4xl mx-auto text-sm md:text-xs">
    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 my-4 text-center md:text-start">Riwayat Pemesanan</h2>

    <div class=" bg-white shadow-lg rounded-sm p-4 mb-5">
        <div class="flex justify-between font-semibold pb-2 border-b border-gray-200">
            <h5>March 06, 2025</h5>
            <p class="">Status | <span class="text-xs bg-blue-400 py-1 px-3 text-white rounded-sm">Selesai</span></p>
        </div>

        <div class="space-y-2 mt-4">
            <!-- Item 1 -->
            <div class="flex items-center p-1 border-b">
                <img src="{{ asset('assets/kabel.png') }}" alt="PS5" class="w-16 h-16 rounded-lg object-cover">
                <div class="ml-4 flex-1">
                    <div class="mb-2 md:mb-0">
                        <h3 class="text-sm font-semibold text-gray-900">PlayStation 5</h3>
                        <p class="text-xs text-gray-500">06 Maret, 2025 - 13 Maret, 2025</p>
                    </div>
                    <div class="flex justify-between text-right mb-2">
                        <p class="font-semibold mt-1">Durasi: 7 Hari</p>
                        <p class="text-sm font-bold">Rp 120,000</p>
                    </div>
                    {{-- <div class="flex justify-end">
                        <a href="" class="bg-emerald-600 py-2 px-4 text-white">
                            Sewa Lagi
                        </a>
                    </div> --}}
                </div>
            </div>
            <!-- Item 1 -->
            <div class="flex items-center p-1 border-b">
                <img src="{{ asset('assets/kabel.png') }}" alt="PS5" class="w-16 h-16 rounded-lg object-cover">
                <div class="ml-4 flex-1">
                    <div class="mb-2 md:mb-0">
                        <h3 class="text-sm font-semibold text-gray-900">Kabel</h3>
                        <p class="text-xs text-gray-500">06 Maret, 2025 - 13 Maret, 2025</p>
                    </div>
                    <div class="flex justify-between text-right mb-2">
                        <p class="font-semibold mt-1">Durasi: 7 Hari</p>
                        <p class="text-sm font-bold">Rp 20,000</p>
                    </div>
                    {{-- <div class="flex justify-end">
                        <a href="" class="bg-emerald-600 py-2 px-4 text-white">
                            Sewa Lagi
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
        
        <!-- Total Section -->
        <div class="mt-4 p-2 mb-2 flex justify-between items-center text-base font-semibold rounded-b-lg">
            <p class="text-gray-700">TOTAL</p>
            <p class="text-red-600 text-lg font-bold">Rp 140,000</p>
        </div>

        <div class="flex justify-end space-x-3 font-semibold items-center">
            <a href="" class="bg-yellow-400 hover:bg-yellow-500 text-center py-2 px-4 w-32">
                Nilai
            </a>
            <a href="" class="border-2 border-gray-800 hover:bg-black hover:text-white text-center py-2 px-4 duration-300 w-32">
                Lihat
            </a>
        </div>
        
    </div>
    
</div>

@endsection