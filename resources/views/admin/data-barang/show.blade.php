<div id="modal-overlay-lihat-barang" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center px-4 z-50">
    <div id="modal-lihat-barang" class="relative w-full max-w-2xl md:max-w-lg p-6 bg-white rounded-lg shadow-lg transform scale-95 opacity-0 transition-all duration-300">
        
        <!-- Tombol Close -->
        <button onclick="closeModalLihatBarang()" class="absolute top-2 right-2 text-gray-400 px-3 py-1 hover:bg-gray-200 rounded-full hover:text-gray-700 text-xl font-bold">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <h1 class="text-lg font-semibold text-center mb-4 border-b pb-2">Lihat Barang</h1>

        <div class="flex space-x-4 items-center mb-4">
            <div><img id="img-barang" src="" alt="Barang" class="w-28 border rounded p-1"></div>
            <div class="flex-1">
                <h4 id="nama-barang" class="font-bold text-base"></h4>
                <p id="harga-barang" class="text-lg text-emerald-700 font-bold"></p>
                <p class="text-xs"><span id="status-barang" class="px-3 py-1 bg-green-200 rounded-full mr-2"></span>Stok = <span id="stok-barang"></span></p>
            </div>
        </div>

        <div class="flex justify-between mb-5 text-sm">
            <div>
                <span class="text-gray-700 block">Kode Barang</span>
                <p id="kode-barang" class="font-semibold"></p>
            </div>
            <div>
                <span class="text-gray-700 block">Kategori Barang</span>
                <p id="kategori-barang" class="font-semibold"></p>
            </div>
        </div>

        <div>
            <span class="text-gray-700">Deskripsi Barang:</span>
            <p id="deskripsi-barang" class="max-h-40 overflow-y-auto text-sm mt-1"></p>
        </div>
    </div>
</div>

<script>
    function openModalLihatBarang(id) {
        fetch(`/admin/data-barang/lihat-barang/${id}`)
            .then(res => res.json())
            .then(data => {
                const barang = data.barang;

                document.getElementById('img-barang').src = `/storage/barangs/${barang.image}`;
                document.getElementById('img-barang').alt = barang.nama_barang;

                document.getElementById('nama-barang').innerText = barang.nama_barang;
                document.getElementById('harga-barang').innerText = 'Rp' + parseInt(data.harga24jam).toLocaleString('id-ID');
                document.getElementById('status-barang').innerText = barang.status_barang;
                document.getElementById('stok-barang').innerText = barang.stok;

                document.getElementById('kode-barang').innerText = barang.kode_barang;
                document.getElementById('kategori-barang').innerText = barang.kategori_barang;
                document.getElementById('deskripsi-barang').innerText = barang.deskripsi;

                let overlay = document.getElementById('modal-overlay-lihat-barang');
                let modal = document.getElementById('modal-lihat-barang');

                overlay.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('scale-95', 'opacity-0');
                    modal.classList.add('scale-100', 'opacity-100');
                }, 50);

                document.body.classList.add('overflow-hidden');
            })
            .catch(err => {
                console.error('Gagal ambil data:', err);
                alert('Gagal menampilkan detail barang.');
            });
    }

    function closeModalLihatBarang() {
        let modal = document.getElementById('modal-lihat-barang');
        let overlay = document.getElementById('modal-overlay-lihat-barang');

        modal.classList.add('scale-95', 'opacity-0');
        modal.classList.remove('scale-100', 'opacity-100');

        setTimeout(() => {
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 300);
    }
</script>
