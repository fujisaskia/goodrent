{{-- Modal Edit Diskon --}}
<div id="modal-overlay-edit-diskon"
    class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center px-4 z-50">
    <div id="modal-edit-diskon"
        class="w-full max-w-2xl md:max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg border border-gray-400 md:border-none transform scale-95 opacity-0 transition-all duration-300">
        <h1 class="text-lg md:text-xl font-semibold mb-6 pb-2 border-b text-center">Edit Diskon</h1>

        <form id="form-edit-diskon" action="{{ route('diskon.update', $diskon->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nama_diskon" class="block text-gray-700 mb-2 text-left w-full capitalize">Nama
                        Diskon</label>
                    <input type="text" name="nama_diskon" id="nama_diskon" value="{{ $diskon->nama_diskon }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>

                <div>
                    <label for="kategori_diskon_id"
                        class="block text-gray-700 mb-2 text-left w-full capitalize">Kategori Diskon</label>
                    <select name="kategori_diskon_id" id="kategori_diskon_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                        <option value="" disabled>Pilih kategori</option>
                        @foreach ($kategoriDiskons as $kategori)
                            <option value="{{ $kategori->id }}" data-nama="{{ Str::slug($kategori->nama, '-') }}"
                                {{ $diskon->kategori_diskon_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="kode_diskon" class="block text-gray-700 mb-2 text-left w-full capitalize">Kode
                        Diskon</label>
                    <input type="text" name="kode_diskon" id="kode_diskon" value="{{ $diskon->kode_diskon }}"
                        readonly
                        class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>

                <div>
                    <label for="besar_diskon" class="block text-gray-700 mb-2 text-left w-full capitalize">Besar
                        Diskon</label>
                    <input type="number" name="besar_diskon" id="besar_diskon" value="{{ $diskon->besar_diskon }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                        required>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-2 text-left w-full capitalize">Masa Berlaku</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                            value="{{ $diskon->tanggal_mulai }}"
                            class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            required>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                            value="{{ $diskon->tanggal_selesai }}"
                            class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            required>
                    </div>
                    <p id="lamaBerlaku" class="text-sm text-red-500 mt-1 italic"></p>
                </div>
            </div>

            <div class="flex space-x-3 justify-end mt-6">
                <button type="button" onclick="closeModalEditDiskon()"
                    class="flex space-x-2 text-white bg-red-500 hover:bg-red-600 focus:bg-red-600 px-6 py-2 rounded">
                    <p>Batal</p>
                </button>
                <button type="submit"
                    class="flex space-x-2 items-center text-white bg-yellow-500 hover:bg-yellow-600 focus:bg-yellow-600 px-4 py-2 rounded">
                    <i class="fa-solid fa-pen"></i>
                    <p>Simpan Perubahan</p>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".btn-edit-diskon").forEach(button => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");

                fetch(`/admin/kelola-diskon/edit/${id}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Gagal mengambil data diskon.");
                        }
                        return response.json();
                    })
                    .then(data => {
                        const form = document.getElementById('form-edit-diskon');

                        // Set form action
                        form.action = `/admin/kelola-diskon/update/${id}`;

                        // Isi data ke form
                        form.querySelector("input[name='nama_diskon']").value = data.diskon
                            .nama_diskon;
                        form.querySelector("select[name='kategori_diskon_id']").value = data
                            .diskon.kategori_diskon_id;
                        form.querySelector("input[name='kode_diskon']").value = data.diskon
                            .kode_diskon;
                        form.querySelector("input[name='besar_diskon']").value = data.diskon
                            .besar_diskon;
                        form.querySelector("input[name='tanggal_mulai']").value = data
                            .diskon.tanggal_mulai;
                        form.querySelector("input[name='tanggal_selesai']").value = data
                            .diskon.tanggal_selesai;

                        // Tampilkan modal
                        document.getElementById('modal-overlay-edit-diskon').classList
                            .remove('hidden');
                        setTimeout(() => {
                            const modal = document.getElementById(
                                'modal-edit-diskon');
                            modal.classList.remove('scale-95', 'opacity-0');
                            modal.classList.add('scale-100', 'opacity-100');
                        }, 50);
                        document.body.classList.add('overflow-hidden');
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Terjadi kesalahan saat memuat data diskon.");
                    });
            });
        });
    });


    // Fungsi close modal
    function closeModalEditDiskon() {
        const overlay = document.getElementById('modal-overlay-edit-diskon');
        const modal = document.getElementById('modal-edit-diskon');

        modal.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            overlay.classList.add('hidden');
        }, 300);
    }

    document.addEventListener("DOMContentLoaded", function() {
        const tanggalSelesaiEl = document.getElementById("tanggal_selesai");
        const tanggalMulaiEl = document.getElementById("tanggal_mulai");

        const tanggalSelesai = flatpickr(tanggalSelesaiEl, {
            altInput: true,
            altFormat: "d F Y",
            dateFormat: "Y-m-d",
            locale: "id",
            minDate: "today",
            defaultDate: tanggalSelesaiEl.value
        });

        flatpickr(tanggalMulaiEl, {
            altInput: true,
            altFormat: "d F Y",
            dateFormat: "Y-m-d",
            locale: "id",
            minDate: "today",
            defaultDate: tanggalMulaiEl.value,
            onChange: function(selectedDates, dateStr) {
                tanggalSelesai.set("minDate", dateStr);
            },
            onReady: function(_, dateStr) {
                tanggalSelesai.set("minDate", dateStr || "today");
            }
        });
    });

    function generateKodeDiskon() {
        const kategoriSelect = document.getElementById('kategori_diskon_id');
        const kodeDiskonInput = document.getElementById('kode_diskon');

        const selectedOption = kategoriSelect.options[kategoriSelect.selectedIndex];
        const kategoriSlug = selectedOption?.getAttribute('data-nama');

        if (kategoriSlug) {
            const kode = kategoriSlug.toUpperCase().replace(/[^A-Z0-9]/g, '') + Math.floor(100 + Math
                .random() * 900);
            kodeDiskonInput.value = kode;
        } else {
            kodeDiskonInput.value = '';
        }
    }

    // Hitung lama berlaku
    const editMulai = document.getElementById('tanggal_mulai');
    const editSelesai = document.getElementById('tanggal_selesai');
    const editLama = document.getElementById('lamaBerlaku');

    function hitungLamaEdit() {
        const mulai = new Date(editMulai.value);
        const selesai = new Date(editSelesai.value);
        if (!isNaN(mulai) && !isNaN(selesai)) {
            const selisih = Math.max(1, Math.ceil((selesai - mulai) / (1000 * 60 * 60 * 24)));
            editLama.innerText = `*${selisih} Hari`;
        } else {
            editLama.innerText = '';
        }
    }

    editMulai?.addEventListener('change', hitungLamaEdit);
    editSelesai?.addEventListener('change', hitungLamaEdit);
</script>
