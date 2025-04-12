{{-- Modal edit diskon --}}

<div id="modal-overlay-edit-kategori-diskon"
    class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center px-4 z-50">
    <div id="modal-edit-kategori-diskon"
        class="w-full max-w-2xl md:max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg border border-gray-400 md:border-none transform scale-95 opacity-0 transition-all duration-300">

        <h1 class="text-lg md:text-xl font-semibold mb-6 pb-2 border-b text-center">Edit Kategori</h1>

        <form action="" class="text-start">
            @csrf
            <div class="space-y-3">
                <div class="">
                    <label for="" class="block text-gray-700 mb-2">Edit Nama Kategori</label>
                    <input type="text" name="" value="PS 5"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>

            </div>

            <div class="flex space-x-3 justify-end mt-6">
                <button type="button" onclick="closeModalEditKategoriDiskon()"
                    class="flex space-x-2 text-white bg-gray-400 hover:bg-gray-500 focus:bg-gray-500 p-2 rounded">
                    <p>Batalkan</p>
                </button>
                <button type="submit"
                    class="flex space-x-2 text-white bg-yellow-600 hover:bg-yellow-700 focus:bg-yellow-600 px-6 py-2 rounded">
                    <p>Simpan</p>
                </button>
            </div>
        </form>

    </div>
</div>
