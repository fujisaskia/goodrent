{{-- Modal Tambah Barang --}}

<div id="modal-overlay-tambah-barang"
    class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center px-4 z-50">
    <div id="modal-tambah-barang"
        class="w-full max-w-2xl md:max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg border border-gray-400 md:border-none transform scale-95 opacity-0 transition-all duration-300">
        <h1 class="text-lg md:text-xl font-semibold mb-6 pb-2 border-b text-center">Tambah Barang Baru</h1>
        <form action="{{ route('data-barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid md:grid-cols-2 gap-4">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <!-- Nama Barang -->
                    <div>
                        <label for="nama_barang" class="block text-gray-700 mb-2">Nama Barang</label>
                        <input type="text" name="nama_barang" placeholder="Silahkan isi nama barang"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            required>
                    </div>

                    <!-- Kategori Barang -->
                    <div>
                        <label for="kategori_barang_id" class="block text-gray-700 mb-2">Kategori Barang</label>
                        <select name="kategori_barang_id" id="kategori_barang_select"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoriBarangs as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kode Barang -->
                    <div>
                        <label for="kode_barang" class="block text-gray-700 mb-2">Kode Barang</label>
                        <input type="text" name="kode_barang" id="kode_barang_input"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            placeholder="Kode barang otomatis akan terisi" readonly>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-gray-700 mb-2">Deskripsi Barang</label>
                        <textarea name="deskripsi" placeholder="Silahkan isi deskripsi"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            rows="3" required></textarea>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    <!-- Harga -->
                    <div>
                        <label for="harga" class="block text-gray-700 mb-2">Harga</label>
                        <input type="number" name="harga" placeholder="Silahkan isi harga"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            required>
                    </div>

                    <!-- Stok -->
                    <div>
                        <label for="stok" class="block text-gray-700 mb-2">Stok</label>
                        <input type="number" name="stok" placeholder="Silahkan isi stok"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            required>
                    </div>

                    <!-- Gambar -->
                    <div>
                        <label for="image" class="block font-medium text-gray-700">Foto Barang</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="mt-1 block w-full p-2 border rounded" required>
                    </div>
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

<script>
    document.getElementById('kategori_barang_select').addEventListener('change', function() {
    const kategoriId = this.value;
    const kodeInput = document.getElementById('kode_barang_input');

    // Reset kode barang jika kategori tidak dipilih
    if (!kategoriId) {
        kodeInput.value = '';
        return;
    }

    // Mengambil kode barang berdasarkan kategori yang dipilih
    fetch(`/get-kode-barang/${kategoriId}`)
        .then(response => {
            // Memeriksa jika status respons sukses (HTTP 2xx)
            if (!response.ok) {
                throw new Error('Gagal mengambil data dari server.');
            }
            return response.json();
        })
        .then(data => {
            if (data.kode_barang) {
                // Menghapus 'S' jika ada dalam kode barang sebelum ditampilkan
                const kodeBarang = data.kode_barang.replace('S', '');
                kodeInput.value = kodeBarang;
            } else {
                // Reset nilai jika kode barang tidak ada
                kodeInput.value = '';
                alert('Gagal mengambil kode barang.');
            }
        })
        .catch(err => {
            // Menangani error jika fetch gagal
            kodeInput.value = '';
            alert('Terjadi kesalahan saat mengambil kode: ' + err.message);
        });
});
</script>
