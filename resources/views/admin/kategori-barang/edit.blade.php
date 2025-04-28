{{-- Modal edit Barang --}}

<div id="modal-overlay-edit-kategori-barang"
    class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center px-4 z-50">
    <div id="modal-edit-kategori-barang"
        class="w-full max-w-2xl md:max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg border border-gray-400 md:border-none transform scale-95 opacity-0 transition-all duration-300">

        <h1 class="text-lg md:text-xl font-semibold mb-6 pb-2 border-b text-center">Edit Kategori Barang</h1>

        <form id="form-edit-kategori-barang" action="{{ route('kategori-barang.update', $kategori->id) }}" method="POST"
            class="text-start">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div class="">
                    <label for="nama" class="block text-gray-700 mb-2">Nama Kategori</label>
                    <input type="text" id="edit-nama-kategori" name="nama" value="{{ $kategori->nama }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>
                <div class="">
                    <label for="status" class="block text-gray-700 mb-2">Status</label>
                    <select id="edit-status-kategori" name="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                        <option value="Draft" {{ $kategori->status == 'Draft' ? 'selected' : '' }}>Draft</option>
                        <option value="Public" {{ $kategori->status == 'Public' ? 'selected' : '' }}>Public</option>
                    </select>
                </div>
            </div>

            <div class="flex space-x-3 justify-end mt-6">
                <button type="button" onclick="closeModalEditKategoriBarang()"
                    class="flex space-x-2 text-white bg-red-500 hover:bg-red-600 focus:bg-red-600 px-6 py-2 rounded">
                    <p>Batal</p>
                </button>
                <button type="submit"
                    class="flex space-x-2 items-center text-white bg-yellow-500 hover:bg-yellow-600 focus:bg-yellow-500 p-2 rounded">
                    <i class="fa-solid fa-pen"></i>
                    <p>Simpan Perubahan</p>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModalEditKategoriBarang(id) {
        let overlay = document.getElementById('modal-overlay-edit-kategori-barang');
        let modal = document.getElementById('modal-edit-kategori-barang');

        // Ambil data via AJAX
        fetch(`/admin/kategori-barang/edit/${id}`)
            .then(response => response.json())
            .then(data => {
                // Isi form
                document.getElementById('edit-nama-kategori').value = data.nama;
                document.getElementById('edit-status-kategori').value = data.status;

                // Set action URL form
                const form = document.getElementById('form-edit-kategori-barang');
                form.action = `/admin/kategori-barang/update/${id}`; // Sesuai route update
            });

        // Tampilkan modal
        overlay.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('scale-95', 'opacity-0');
            modal.classList.add('scale-100', 'opacity-100');
        }, 50);
        document.body.classList.add('overflow-hidden');
    }

    function closeModalEditKategoriBarang() {
        let modal = document.getElementById('modal-edit-kategori-barang');
        let overlay = document.getElementById('modal-overlay-edit-kategori-barang');

        // Tambahkan animasi keluar
        modal.classList.add('scale-95', 'opacity-0');
        modal.classList.remove('scale-100', 'opacity-100');

        // Tunggu animasi selesai sebelum menyembunyikan modal
        setTimeout(() => {
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 300); // Sesuai dengan durasi transition (300ms)
    }
</script>