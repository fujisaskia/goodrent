    {{-- Modal Tambah Diskon --}}

    <div id="modal-overlay-tambah-diskon"
        class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center px-4 z-50">
        <div id="modal-tambah-diskon"
            class="w-full max-w-2xl md:max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg border border-gray-400 md:border-none transform scale-95 opacity-0 transition-all duration-300">
            <h1 class="text-lg md:text-xl font-semibold mb-6 pb-2 border-b text-center">Tambah Diskon Baru</h1>

            <form action="{{ route('diskon.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama_diskon" class="block text-gray-700 mb-2 capitalize">Nama Diskon</label>
                        <input type="text" name="nama_diskon" id="nama_diskon" placeholder="Silahkan isi nama diskon"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            required>
                    </div>

                    <div>
                        <label for="kategori_diskon_id" class="block text-gray-700 mb-2 capitalize">Kategori
                            Diskon</label>
                        <select name="kategori_diskon_id" id="kategori_diskon_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            required onchange="generateKodeDiskon()">
                            <option value="" disabled selected>Pilih kategori</option>
                            @foreach ($kategoriDiskons as $kategori)
                                @if ($kategori->status !== 'Draft')
                                    <option value="{{ $kategori->id }}"
                                        data-nama="{{ Str::slug($kategori->nama, '-') }}">
                                        {{ $kategori->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="kode_diskon" class="block text-gray-700 mb-2 capitalize">Kode Diskon</label>
                        <input type="text" name="kode_diskon" id="kode_diskon" readonly
                            class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            required>
                    </div>

                    <div>
                        <label for="besar_diskon" class="block text-gray-700 mb-2 capitalize">Besar Diskon</label>
                        <input type="text" name="besar_diskon" id="besar_diskon" placeholder="cth: 5.000"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                            required>
                        <span class="font-bold text-[11px] text-red-600">*Masukkan berupa Rupiah</span>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-gray-700 mb-2 capitalize">Masa Berlaku</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                                required>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-200"
                                required>
                        </div>
                        <p id="lamaBerlaku" class="text-sm text-red-500 mt-1 italic"></p>
                    </div>
                </div>

                <div class="flex space-x-3 justify-end mt-6">
                    <button type="button" onclick="closeModalTambahDiskon()"
                        class="flex space-x-2 text-white bg-red-500 hover:bg-red-600 focus:bg-red-600 px-6 py-2 rounded">
                        <p>Batal</p>
                    </button>
                    <button type="submit"
                        class="flex space-x-2 items-center text-white bg-green-600 hover:bg-green-700 focus:bg-green-600 p-2 rounded">
                        <i class="fa-solid fa-plus"></i>
                        <p>Tambah Diskon</p>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        flatpickr("#tanggal_mulai", {
            altInput: true,
            altFormat: "d F Y", // untuk tampilan: 17 April 2025
            dateFormat: "Y-m-d", // untuk nilai yang dikirim ke server: 2025-04-17
            locale: "id",
            minDate: "today",
            onChange: function(selectedDates, dateStr) {
                tanggalSelesai.set("minDate", dateStr);
            }
        });

        let tanggalSelesai = flatpickr("#tanggal_selesai", {
            altInput: true,
            altFormat: "d F Y",
            dateFormat: "Y-m-d",
            locale: "id",
            minDate: new Date()
        });

        function generateKodeDiskon() {
            const kategoriSelect = document.getElementById('kategori_diskon_id');
            const kodeDiskonInput = document.getElementById('kode_diskon');

            const selectedOption = kategoriSelect.options[kategoriSelect.selectedIndex];
            const kategoriSlug = selectedOption?.getAttribute('data-nama');

            if (kategoriSlug) {
                const kode = kategoriSlug.toUpperCase().replace(/[^A-Z0-9]/g, '') + Math.floor(100 + Math.random() * 900);
                kodeDiskonInput.value = kode;
            } else {
                kodeDiskonInput.value = '';
            }
        }

        const tglMulaiInput = document.getElementById('tanggal_mulai');
        const tglSelesaiInput = document.getElementById('tanggal_selesai');
        const lamaBerlaku = document.getElementById('lamaBerlaku');

        function hitungLamaBerlaku() {
            const start = new Date(tglMulaiInput.value);
            const end = new Date(tglSelesaiInput.value);
            if (!isNaN(start) && !isNaN(end)) {
                const selisih = Math.max(1, Math.ceil((end - start) / (1000 * 60 * 60 * 24)));
                lamaBerlaku.innerText = `*${selisih} Hari`;
            } else {
                lamaBerlaku.innerText = '';
            }
        }

        tglMulaiInput.addEventListener('change', hitungLamaBerlaku);
        tglSelesaiInput.addEventListener('change', hitungLamaBerlaku);

        const inputDiskon = document.getElementById('besar_diskon');

        // Format saat ketik
        inputDiskon.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // ambil angka aja
            e.target.value = new Intl.NumberFormat('id-ID').format(value); // format ribuan
        });

        // Hapus format sebelum submit
        const form = inputDiskon.closest('form');
        if (form) {
            form.addEventListener('submit', function() {
                inputDiskon.value = inputDiskon.value.replace(/\D/g, ''); // bersihkan koma/titik sebelum kirim
            });
        }
    </script>
