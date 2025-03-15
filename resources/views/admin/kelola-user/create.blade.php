<div id="modal-overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center px-4 z-50">
    <div id="modal"
        class="w-full max-w-2xl md:w-[600px] mx-auto p-8 bg-white rounded-lg shadow-lg border border-gray-400 md:border-none transform scale-95 opacity-0 transition-all duration-300">
        <h1 class="text-lg md:text-xl font-semibold mb-6 pb-2 border-b text-center">Tambah User Baru</h1>

        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div class="">
                    <label for="" class="block text-gray-700 mb-2">Nama</label>
                    <input type="text" name="" placeholder="silahkan isi nama anda"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>

                <div class="">
                    <label for="" class="block text-gray-700 mb-2">E-Mail</label>
                    <input type="email" name="" placeholder="silahkan isi e-mail"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>

                <div class="">
                    <label for="" class="block text-gray-700 mb-2">Password</label>
                    <input type="password" name="" placeholder="buat password"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>
            </div>

            <div class="flex space-x-3 justify-end mt-6">
                <button type="button" onclick="closeModalTambahAdmin()"
                    class="flex space-x-2 text-white bg-red-500 hover:bg-red-600 focus:bg-red-600 p-2 rounded-lg">
                    <p>Batalkan</p>
                </button>
                <button type="submit"
                    class="flex space-x-2 text-white bg-green-600 hover:bg-green-700 focus:bg-green-600 py-2 px-6 rounded-lg">
                    <p>Tambah</p>
                </button>
            </div>
        </form>

    </div>
</div>
