{{-- Modal edit diskon --}}

<div id="modal-overlay-edit-kategori-diskon"
    class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center px-4 z-50">
    <div id="modal-edit-kategori-diskon"
        class="w-full max-w-2xl md:max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg border border-gray-400 md:border-none transform scale-95 opacity-0 transition-all duration-300">

        <h1 class="text-lg md:text-xl font-semibold mb-6 pb-2 border-b text-center">Edit Kategori</h1>

        <form id="form-edit-kategori-diskon" action="{{ route('kategori-diskon.update', $kategori->id) }}" method="POST" class="text-start">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div class="">
                    <label for="nama" class="block text-gray-700 mb-2">Jenis PS</label>
                    <input type="text" id="nama-kategori-diskon" name="nama"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>
                <div class="">
                    <label for="status" class="block text-gray-700 mb-2">Status</label>
                    <select id="status-kategori-diskon" name="status""
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                        <option value="Draft" {{ $kategori->status == 'Draft' ? 'selected' : '' }}>Draft</option>
                        <option value="Public" {{ $kategori->status == 'Public' ? 'selected' : '' }}>Public</option>
                    </select>
                </div>
            </div>

            <div class="flex space-x-3 justify-end mt-6">
                <button type="button" onclick="closeModalEditKategoriDiskon()"
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
    // membuka modal edit diskon
    document.querySelectorAll('.btn-edit-kategori-diskon').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.getAttribute('data-kategori-id');
            openModalEditKategoriDiskon(itemId);
        });
    });

    function openModalEditKategoriDiskon(id) {
    let overlay = document.getElementById('modal-overlay-edit-kategori-diskon');
    let modal = document.getElementById('modal-edit-kategori-diskon');

    // Ambil data via AJAX
    fetch(`/admin/kategori-diskon/edit/${id}`)
        .then(response => response.json())
        .then(data => {
            const form = document.getElementById('form-edit-kategori-diskon');
            const namaInput = document.getElementById('nama-kategori-diskon');
            const statusSelect = document.getElementById('status-kategori-diskon');

            // Check if the form and its inputs exist
            if (form && namaInput && statusSelect) {
                // Isi form
                namaInput.value = data.kategoriDiskon.nama; // Corrected the data key
                statusSelect.value = data.kategoriDiskon.status;

                // Set action URL form
                form.action = `/admin/kategori-diskon/update/${id}`;
            } else {
                console.error('Form or input elements not found');
            }
        })
        .catch(error => console.error('Error:', error));

    // Tampilkan modal
    overlay.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.remove('scale-95', 'opacity-0');
        modal.classList.add('scale-100', 'opacity-100');
    }, 50);
    document.body.classList.add('overflow-hidden');
}

    // menutup modal edit diskon
    function closeModalEditKategoriDiskon() {
        let modal = document.getElementById('modal-edit-kategori-diskon');
        let overlay = document.getElementById('modal-overlay-edit-kategori-diskon');

        // Tambahkan animasi keluar
        modal.classList.add('scale-95', 'opacity-0');
        modal.classList.remove('scale-100', 'opacity-100');

        // Tunggu animasi selesai sebelum menyembunyikan modal
        setTimeout(() => {
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 300); // Sesuai dengan durasi transition (300ms)
    }

    // Handle form submission via AJAX
    document.getElementById('edit-kategori-diskon-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        const formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': formData.get('_token') // Include CSRF token in the header
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Kategori updated successfully!');
                closeModalEditKategoriDiskon();
                // Optionally, you can update the UI or reload the page
            } else {
                alert('Failed to update kategori!');
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
