{{-- Modal Tambah Barang --}}

<div id="modal-overlay-tambah-barang"
    class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center px-4 z-50">
    <div id="modal-tambah-barang"
        class="w-full max-w-2xl md:max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg border border-gray-400 md:border-none transform scale-95 opacity-0 transition-all duration-300">
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
                <button type="button" onclick="closeModalTambahBarang()"
                    class="flex space-x-2 text-white bg-gray-400 hover:bg-gray-500 focus:bg-gray-500 p-2 rounded">
                    <p>Batalkan</p>
                </button>
                <button type="submit"
                    class="flex space-x-2 items-center text-white bg-green-600 hover:bg-green-700 focus:bg-green-600 p-2 rounded">
                    <i class="fa-solid fa-plus"></i>
                    <p>Tambah Barang</p>
                </button>
            </div>
        </form>


    </div>
</div>
