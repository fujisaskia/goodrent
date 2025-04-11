{{-- Modal edit Barang --}}

<div id="modal-overlay-edit-barang"
    class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center px-4 z-50">
    <div id="modal-edit-barang"
        class="w-full max-w-2xl md:max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg border border-gray-400 md:border-none transform scale-95 opacity-0 transition-all duration-300">

        <h1 class="text-lg md:text-xl font-semibold mb-6 pb-2 border-b text-center">Edit Barang</h1>

        <form action="" class="text-start">
            @csrf
            <div class="space-y-3">
                <div class="">
                    <label for="" class="block text-gray-700 mb-2">Jenis PS</label>
                    <input type="text" name="" value="PS 5"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>

                <div class="">
                    <label for="" class="block text-gray-700 mb-2">Deskripsi Barang</label>
                    <textarea name=""
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        rows="3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad odio, laboriosam voluptatum quasi unde perferendis soluta autem, iusto asperiores, similique expedita nulla provident corporis inventore minima quo maxime? Et pariatur cumque reprehenderit, eveniet sit ducimus suscipit velit quia sunt modi voluptates repudiandae quas dicta deserunt maiores doloribus. Dolor, debitis culpa.</textarea>
                </div>

                <div class="">
                    <label for="" class="block text-gray-700 mb-2">Harga</label>
                    <input type="number" name="" value="50000"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>

                {{-- foto --}}
                <div class="">
                    <label for="photos" class="block font-medium text-gray-700">Foto Barang</label>
                    <div class="grid grid-cols-3 md:grid-cols-7 gap-4">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                            alt="nama_ps" class="w-16 rounded-sm">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                            alt="nama_ps" class="w-16 rounded-sm">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                            alt="nama_ps" class="w-16 rounded-sm">
                        <img src="https://i.pinimg.com/736x/38/7a/74/387a74d7d7cc5f4c17b60b99453bf653.jpg"
                            alt="nama_ps" class="w-16 rounded-sm">
                    </div>
                </div>

                <div class="">
                    <label for="photos" class="block font-medium text-gray-700">Ubah Foto</label>
                    <input type="file" id="photos" name="photos[]" multiple accept="image/*"
                        class="mt-1 block w-full p-2 border rounded">
                </div>

            </div>

            <div class="flex space-x-3 justify-end mt-6">
                <button type="button" onclick="closeModalEditBarang()"
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
