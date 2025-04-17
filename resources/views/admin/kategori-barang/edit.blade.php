{{-- Modal edit Barang --}}

<div id="modal-overlay-edit-kategori-barang"
    class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center px-4 z-50">
    <div id="modal-edit-kategori-barang"
        class="w-full max-w-2xl md:max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg border border-gray-400 md:border-none transform scale-95 opacity-0 transition-all duration-300">

        <h1 class="text-lg md:text-xl font-semibold mb-6 pb-2 border-b text-center">Edit Kategori Barang</h1>

        <form action="{{ route('kategori-barang.update', $kategori->id) }}" method="POST" class="text-start">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div class="">
                    <label for="nama" class="block text-gray-700 mb-2">Jenis PS</label>
                    <input type="text" name="nama" value="{{ $kategori->nama }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>
                <div class="">
                    <label for="status" class="block text-gray-700 mb-2">Status</label>
                    <select name="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                        <option value="Draft" {{ $kategori->status == 'Draft' ? 'selected' : '' }}>Draft</option>
                        <option value="Public" {{ $kategori->status == 'Public' ? 'selected' : '' }}>Public</option>
                    </select>
                </div>
            </div>

            <div class="flex space-x-3 justify-end mt-6">
                <button type="button" onclick="closeModalEditKategoriBarang()"
                    class="flex space-x-2 text-white bg-red-500 hover:bg-red-600 focus:bg-red-600 p-2 rounded">
                    <p>Batalkan</p>
                </button>
                <button type="submit"
                    class="flex space-x-2 text-white bg-yellow-600 hover:bg-yellow-700 focus:bg-yellow-600 p-2 rounded">
                    <p>Simpan</p>
                </button>
            </div>
        </form>
    </div>
</div>