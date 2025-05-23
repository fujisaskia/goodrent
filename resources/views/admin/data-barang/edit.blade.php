{{-- Modal edit Barang --}}

<div id="modal-overlay-edit-barang"
    class="fixed inset-0 bg-black bg-opacity-50 hidden flex text-start items-center justify-center px-4 z-50">
    <div id="modal-edit-barang"
        class="w-full max-w-2xl md:max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg border border-gray-400 md:border-none transform scale-95 opacity-0 transition-all duration-300">
        <h1 class="text-lg md:text-xl font-semibold mb-6 pb-2 border-b text-center">Edit Barang</h1>
        {{-- {{dd($barangs)}} --}}
        <form action="{{ route('data-barang.update', ['id' => $barang->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-4">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <!-- Nama Barang -->
                    <div>
                        <label for="nama_barang" class="block text-gray-700 mb-2">Nama Barang</label>
                        <input type="text" name="nama_barang" value="" placeholder="Silahkan isi nama barang"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            required>
                    </div>

                    <div class="flex flex-row md:flex-col space-x-3 md:space-x-0">
                        <!-- Kategori Barang -->
                        <div class="w-full">
                            <label for="kategori_barang_id" class="block text-gray-700 mb-2">Kategori Barang</label>
                            <select name="kategori_barang_id" id="kategori_barang_select"
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                                required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategoriBarangs as $kategori)
                                    @if ($kategori->status !== 'Draft')
                                        <option value="{{ $kategori->id }}"
                                            {{ $barang->kategori_barang_id == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <!-- Kode Barang -->
                        <div class="w-full">
                            <label for="kode_barang" class="block text-gray-700 mb-2">Kode Barang</label>
                            <input type="text" name="kode_barang" id="kode_barang_input"
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                                value="{{ $barang->kode_barang }}" placeholder="Kode barang otomatis akan terisi"
                                readonly>
                        </div>
                    </div>


                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-gray-700 mb-2">Deskripsi Barang</label>
                        <textarea name="deskripsi" placeholder="Silahkan isi deskripsi"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            rows="6" required>{{ $barang->deskripsi }}</textarea>
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Kolom Kanan -->
                    <div class="flex flex-row md:flex-col space-x-3 md:space-x-0">
                        <!-- Harga -->
                        <div class="w-full">
                            <label for="harga" class="block text-gray-700 mb-2">Harga</label>
                            <input type="number" name="harga" value="{{ old('harga', $harga24jam) }}"
                                placeholder="Silahkan isi harga"
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                                required>
                        </div>

                        <!-- Stok -->
                        <div class="w-full">
                            <label for="stok" class="block text-gray-700 mb-2">Stok</label>
                            <input type="number" name="stok" value="{{ $barang->stok }}"
                                placeholder="Silahkan isi stok"
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                                required>
                        </div>

                    </div>

                    <div class="flex flex-row md:flex-col space-x-3 md:space-x-0">
                        <!-- Foto Lama -->
                        <div class="w-full">
                            <label class="block font-medium text-gray-700">Foto Barang Lama</label>
                            <div class="flex justify-start items-start mb-4">
                                @if ($barang->image)
                                    <img src="{{ asset('storage/barangs/' . $barang->image) }}"
                                        alt="{{ $barang->nama_barang }}" class="w-28 rounded-sm">
                                @else
                                    <p class="text-sm text-gray-500 italic">Tidak ada foto</p>
                                @endif
                            </div>
                        </div>

                        <!-- Gambar -->
                        <div>
                            <label for="image" class="block font-medium text-gray-700">Foto Barang</label>
                            <input type="file" id="image" name="image" accept="image/*"
                                class="mt-1 block w-full p-2 border rounded">
                            <small class="text-xs text-gray-500">Biarkan kosong jika tidak ingin mengganti.</small>
                        </div>
                    </div>
                </div>

            </div>

            <div class="flex space-x-3 justify-end mt-8">
                <button type="button" onclick="closeModalEditBarang()"
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
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".btn-edit-barang").forEach(button => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");

                fetch(`/admin/data-barang/edit/${id}`)
                    .then(response => {
                        if (!response.ok) throw new Error("Network error");
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                            return;
                        }

                        // Isi form
                        const modal = document.getElementById('modal-overlay-edit-barang');
                        modal.classList.remove("hidden");

                        // Set action URL form
                        const form = modal.querySelector("form");
                        form.action = `/admin/data-barang/update/${data.id}`;

                        // Isi input field
                        form.querySelector("input[name='nama_barang']").value = data
                            .nama_barang;
                        form.querySelector("select[name='kategori_barang_id']").value = data
                            .kategori_barang_id;
                        form.querySelector("input[name='kode_barang']").value = data
                            .kode_barang;
                        form.querySelector("textarea[name='deskripsi']").value = data
                            .deskripsi;
                        form.querySelector("input[name='harga']").value = data.harga;
                        form.querySelector("input[name='stok']").value = data.stok;

                        // Foto lama
                        const fotoContainer = form.querySelector(".flex.justify-start img");
                        const noFotoText = form.querySelector(".flex.justify-start p");

                        if (data.image) {
                            if (fotoContainer) fotoContainer.src = data.image;
                            if (noFotoText) noFotoText.classList.add("hidden");
                        } else {
                            if (fotoContainer) fotoContainer.classList.add("hidden");
                            if (noFotoText) noFotoText.classList.remove("hidden");
                        }

                        // Tampilkan modal
                        setTimeout(() => {
                            document.getElementById('modal-edit-barang').classList
                                .remove('scale-95', 'opacity-0');
                        }, 50);
                    })
                    .catch(error => {
                        console.error("Gagal ambil data:", error);
                        alert("Gagal ambil data barang.");
                    });
            });
        });
    });

    // Fungsi close modal
    function closeModalEditBarang() {
        const overlay = document.getElementById('modal-overlay-edit-barang');
        const modal = document.getElementById('modal-edit-barang');

        modal.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            overlay.classList.add('hidden');
        }, 300);
    }

    document.getElementById('kategori_barang_select').addEventListener('change', function() {
        const kategoriId = this.value;
        const kodeInput = document.getElementById('kode_barang_input');

        if (kategoriId) {
            fetch(`/get-kode-barang/${kategoriId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.kode_barang) {
                        kodeInput.value = data.kode_barang;
                    } else {
                        kodeInput.value = '';
                        alert('Gagal mengambil kode barang.');
                    }
                })
                .catch(err => {
                    kodeInput.value = '';
                    alert('Terjadi kesalahan saat mengambil kode.');
                });
        } else {
            kodeInput.value = '';
        }
    });
</script>
