<div id="modal-overlay-lihat-barang"
    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center px-4 z-50">
    <div class="relative w-full max-w-2xl md:max-w-lg p-6 bg-white rounded-lg shadow-lg">
        <button onclick="closeModal()"
            class="absolute top-2 right-2 text-gray-400 px-3 py-1 hover:bg-gray-200 rounded-full hover:text-gray-700 text-xl font-bold">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <h1 class="text-lg font-semibold text-center">Lihat Pesanan</h1>
        <div id="modal-content"></div>
    </div>
</div>


<script>
    function showDetail(id) {
        fetch(`/pesanan/${id}`)
            .then(res => res.json())
            .then(data => {
                const user = data.user || {};
                const items = data.items || [];
                const pesanan = data.pesanan || {};
                const statusPemesanan = pesanan.status_pemesanan || '-';

                const statusColorPemesanan = statusPemesanan === 'Menunggu' ? 'bg-gray-500' :
                    statusPemesanan === 'Dalam Penyewaan' ? 'bg-orange-500' :
                    statusPemesanan === 'Selesai' ? 'bg-green-600' : 'bg-red-500';

                let html = `
                <div class="mb-4 border-b pb-2">
                    <div class="w-1/3 mx-auto text-center">
                        <h4 class="text-xs text-white ${statusColorPemesanan} py-1 px-3 rounded-full">
                            ${statusPemesanan}
                        </h4>
                    </div>
                </div>
                <div class="w-full md:w-2/3 mb-4 flex justify-between gap-4">
                    <div>
                        <p class="text-xs text-gray-700">Nama Pelanggan</p>
                        <h4 class="font-semibold text-sm">${user.name || '-'}</h4>
                    </div>
                    <div>
                        <p class="text-xs text-gray-700">No HP</p>
                        <h4 class="font-semibold text-sm">${user.no_telp || '-'}</h4>
                    </div>
                </div>
                <div class="space-y-3 mt-2">
            `;

                items.forEach(item => {
                    const barang = item.barang || {};
                    html += `
                    <div class="flex items-center border-b pb-2 gap-3">
                        <img src="/storage/barangs/${barang.image}" alt="${barang.nama_barang}" class="w-12 h-12 rounded object-cover">
                        <div class="flex-1">
                            <h3 class="text-sm font-semibold">${barang.nama_barang || '-'}</h3>
                            <p class="text-xs text-gray-500">${item.tanggal_mulai} - ${item.tanggal_selesai}</p>
                            <div class="flex justify-between mt-1 text-xs">
                                <p>Durasi: ${item.durasi_sewa >= 24 ? Math.floor(item.durasi_sewa / 24) + ' Hari' : item.durasi_sewa + ' Jam'}</p>
                                <p class="font-bold">Rp${parseInt(item.harga_barang).toLocaleString()}</p>
                            </div>
                        </div>
                    </div>
                `;
                });

                const statusPembayaran = data.pembayaran.status_pembayaran;
                const statusColorPembayaran = statusPembayaran === 'Berhasil' ? 'bg-green-600' :
                    statusPembayaran === 'Menunggu' ? 'bg-orange-500' : 'bg-gray-400';

                html += `
                </div>
                <div class="my-3 flex justify-between text-sm font-semibold text-blue-500">
                    <p>Potongan Harga</p>
                    <p>- Rp${parseInt(data.potongan_harga).toLocaleString()}</p>
                </div>
                <div class="flex justify-between items-center text-base font-semibold">
                    <p class="text-gray-700">TOTAL</p>
                    <p class="text-red-600 text-lg font-bold">Rp${parseInt(data.total_bayar).toLocaleString()}</p>
                </div>
                <div class="flex justify-between items-center text-sm mt-2 bg-gray-100 rounded-md p-2 font-semibold">
                    <p class="text-gray-700">Status Pembayaran</p>
                    <p class="text-white text-xs font-bold ${statusColorPembayaran} rounded-full px-4 py-1">${statusPembayaran}</p>
                </div>
            `;

                document.getElementById('modal-content').innerHTML = html;
                document.getElementById('modal-overlay-lihat-barang').classList.remove('hidden');
                document.getElementById('modal-overlay-lihat-barang').classList.add('flex');
            })
            .catch(err => {
                console.error('Gagal ambil data:', err);
            });
    }


    function closeModal() {
        document.getElementById('modal-overlay-lihat-barang').classList.remove('flex');
        document.getElementById('modal-overlay-lihat-barang').classList.add('hidden');
    }
</script>



{{-- <script>
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
</script> --}}
