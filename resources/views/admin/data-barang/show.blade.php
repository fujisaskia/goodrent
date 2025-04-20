{{-- Modal Lihat Barang --}}

<div id="modal-overlay-lihat-barang"
    class="fixed inset-0 bg-black bg-opacity-50 hidden flex text-start items-center justify-center px-4 z-50">
    <div id="modal-lihat-barang"
        class="relative w-full max-w-2xl md:max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg border border-gray-400 md:border-none transform scale-95 opacity-0 transition-all duration-300">
        
        <!-- Tombol X (close) -->
        <button onclick="closeModalLihatBarang()" 
            class="absolute top-2 right-2 text-gray-400 px-3 py-1 hover:bg-gray-200 rounded-full hover:text-gray-700 text-2xl font-bold">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <h1 class="text-lg md:text-xl font-semibold my-4 pb-2 border-b text-center">Lihat Barang</h1>

        <div class="flex space-x-4 items-center">
            <div class="flex">
                <img src="{{ asset('storage/barangs/' . $barang->image) }}"
                alt="{{ $barang->nama_barang }}" class="w-28 p-2 border border-gray-200 rounded">
            </div>

            <div class="flex-1">
                <h4 class="text-base font-bold">{{ $barang->nama_barang }}</h4>
                <p class="text-xl md:text-lg font-bold text-emerald-700 mb-2">
                    Rp{{ number_format(old('harga', $harga24jam), 0, ',', '.') }}
                </p>
                <p class="text-xs"><span class="p-1 px-3 bg-green-200 rounded-full mr-2">{{ $barang->status_barang }}</span> Stok = {{ $barang->stok }} </p>
            </div>
        </div>

        <div class="flex justify-between my-5 md:w-2/3">
            <div class="flex flex-col space-y-1">
                <span class="text-gray-700">Kode Barang</span>
                <p class="font-semibold">{{ $barang->kode_barang }}</p>
            </div>

            <div class="flex flex-col space-y-1">
                <span class="text-gray-700">Kategori Barang</span>
                <p class="font-semibold">{{ $barang->kode_barang }}</p>
            </div>
        </div>

        <div class="flex flex-col space-y-1">
            <span class="text-gray-700">Deskripsi Barang :</span>
            <p class="w-full">{{ $barang->deskripsi }}</p>
        </div>
    </div>
</div>

