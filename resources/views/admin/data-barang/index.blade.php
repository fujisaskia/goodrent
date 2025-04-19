@extends('layouts/admin')

@section('title', 'Data Barang GoodRent')

@section('content')

    <div class="mx-auto p-2">
        <h2 class="flex space-x-3 text-2xl md:text-3xl font-bold mb-4 items-center justify-center md:justify-start">
            <i class="fa-solid fa-box-open text-emerald-800"></i>
            <span>Data Barang</span>
        </h2>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row justify-between mb-4">
                <form method="GET" action="{{ route('data-barang.index') }}">
                    <div class="flex space-x-3">
                        <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari Barang"
                            class="border p-3 rounded-lg w-60 focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                        <button type="submit" class="py-3 px-4 bg-emerald-600 rounded-full text-white focus:scale-95 duration-300">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>                
                <div class="flex justify-end gap-3">
                    {{-- Tombol Hapus Semua --}}
                    <form action="{{ route('data-barang.destroySelected') }}" method="POST" id="bulk-delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" id="bulk-delete-btn"
                            class="bg-red-700 hover:bg-red-800 text-white p-3 rounded-lg items-center focus:scale-95 duration-300 hidden transition-all ease-in-out">
                            <i class="fa-solid fa-trash"></i>
                            <span>Hapus Semua</span>
                        </button>
                    </form>
                    <div class="flex justify-end">
                        <button onclick="openModalTambahBarang()"
                            class="bg-green-700 hover:bg-green-800 flex space-x-2 text-white p-3 rounded-lg items-center focus:scale-95 duration-300">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tambah Barang</span>
                        </button>

                        {{-- Modal Tambah Data Barang  --}}
                        @include('admin.data-barang.create')
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto lg:overflow-visible">
                <table class="w-full border-collapse border rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-500 text-white uppercase">
                            <th class="p-3"><input type="checkbox" id="select_all" class="select-all-checkbox"></th>
                            <th class="p-3">No</th>
                            <th class="p-3">Jenis PS</th>
                            <th class="p-3">Foto Barang</th>
                            <th class="p-3">Stock Barang</th>
                            <th class="p-3">Harga Sewa</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangs as $index => $barang)
                            <tr class="border-b text-center hover:bg-gray-50">
                                <td><input type="checkbox" name="ids[]" value="{{ $barang->id }}" class="item-checkbox">
                                </td>
                                <td class="p-3">
                                    {{ $loop->iteration + ($barangs->currentPage() - 1) * $barangs->perPage() }}</td>
                                <td class="p-3">{{ $barang->nama_barang }}</td>
                                <td class="flex justify-center p-3">
                                    <img src="{{ asset('storage/barangs/' . $barang->image) }}"
                                        alt="{{ $barang->nama_barang }}" class="w-24 h-auto rounded">
                                </td>
                                <td class="p-3">{{ $barang->stok }} Unit</td>
                                <td class="p-3">
                                    @php
                                        $harga24jam = $barang->hargaSewas->where('durasi_jam', 24)->first();
                                    @endphp

                                    Rp {{ number_format($harga24jam?->harga ?? 0, 0, ',', '.') }} / 24 jam
                                </td>
                                <td class="p-3">
                                    @if ($barang->stok > 0)
                                        <span class="bg-green-200 text-green-800 font-semibold py-1 px-3 rounded-full">
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="bg-red-200 text-red-800 font-semibold py-1 px-3 rounded-full">
                                            Tidak Tersedia
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center justify-center gap-2 h-full">
                                        {{-- button lihat --}}
                                        <a href="{{ route('lihat.produk', $barang->id) }}">
                                            @include('components.crud.read')
                                        </a>

                                        {{-- button edit --}}
                                        <button
                                            class="btn-edit-barang bg-yellow-500 hover:bg-yellow-600 shadow-md shadow-yellow-300 hover:shadow-none focus:scale-95 duration-300 
                                        text-white py-2 px-2.5 rounded-full"
                                            title="Edit Barang" data-id="{{ $barang->id }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                        {{-- Modal edit (optional, bisa pakai ID atau modal global) --}}
                                        @include('admin.data-barang.edit')

                                        {{-- button hapus --}}
                                        <form action="{{ route('data-barang.destroy', $barang->id) }}" method="POST"
                                            id="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            @include('components.crud.delete')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center p-5 text-gray-500">Data barang tidak tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Pagination --}}
        <div class="flex justify-center mt-5">
            {{ $barangs->links() }}
        </div>

    </div>

    <script>
        document.querySelectorAll('#delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                Swal.fire({
                    title: "Yakin Hapus?",
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#9ca3af",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal",
                    customClass: {
                        confirmButton: 'rounded-full',
                        cancelButton: 'rounded-full'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('form')
                            .submit(); // Ambil form terdekat dari tombol yang diklik
                    }
                });
            });
        });

        // membuka modal tambah barang
        function openModalTambahBarang() {
            let overlay = document.getElementById('modal-overlay-tambah-barang');
            let modal = document.getElementById('modal-tambah-barang');

            // Tampilkan overlay
            overlay.classList.remove('hidden');

            // Beri jeda untuk animasi
            setTimeout(() => {
                modal.classList.remove('scale-95', 'opacity-0');
                modal.classList.add('scale-100', 'opacity-100');
            }, 50);

            document.body.classList.add('overflow-hidden'); // Mencegah scroll saat modal terbuka
        }

        // menutup modal tambah barang
        function closeModalTambahBarang() {
            let modal = document.getElementById('modal-tambah-barang');
            let overlay = document.getElementById('modal-overlay-tambah-barang');

            // Tambahkan animasi keluar
            modal.classList.add('scale-95', 'opacity-0');
            modal.classList.remove('scale-100', 'opacity-100');

            setTimeout(() => {
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');

                // Reset semua field di dalam form
                const form = modal.querySelector('form');
                if (form) {
                    form.reset();
                }

                // Reset kode barang jika perlu
                const kodeBarangInput = document.getElementById('kode_barang_input');
                if (kodeBarangInput) {
                    kodeBarangInput.value = '';
                }
            }, 300);
        }

        // membuka modal edit barang
        document.querySelectorAll('.btn-edit-barang').forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-barang-id');
                openModalEditBarang(itemId);
            });
        });

        function openModalEditBarang(id) {
            let overlay = document.getElementById('modal-overlay-edit-barang');
            let modal = document.getElementById('modal-edit-barang');

            // Bisa juga tambahkan logika untuk menampilkan data sesuai id

            overlay.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('scale-95', 'opacity-0');
                modal.classList.add('scale-100', 'opacity-100');
            }, 50);

            document.body.classList.add('overflow-hidden');
        }

        // menutup modal edit barang
        function closeModalEditBarang() {
            let modal = document.getElementById('modal-edit-barang');
            let overlay = document.getElementById('modal-overlay-edit-barang');

            // Tambahkan animasi keluar
            modal.classList.add('scale-95', 'opacity-0');
            modal.classList.remove('scale-100', 'opacity-100');

            // Tunggu animasi selesai sebelum menyembunyikan modal
            setTimeout(() => {
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300); // Sesuai dengan durasi transition (300ms)
        }

        document.addEventListener('DOMContentLoaded', function() {
            const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
            const bulkDeleteForm = document.getElementById('bulk-delete-form');
            const checkboxes = document.querySelectorAll('input[name="ids[]"]');
            const selectAll = document.getElementById('select_all');

            function toggleBulkDeleteButton() {
                const selectedCount = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
                if (selectedCount > 1) {
                    bulkDeleteBtn.classList.remove('hidden');
                } else {
                    bulkDeleteBtn.classList.add('hidden');
                }
            }

            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = selectAll.checked;
                    });
                    toggleBulkDeleteButton();
                });
            }

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', toggleBulkDeleteButton);
            });

            toggleBulkDeleteButton();

            bulkDeleteBtn.addEventListener('click', function(e) {
                e.preventDefault();

                // Bersihkan input hidden sebelumnya
                document.querySelectorAll('#bulk-delete-form input[type="hidden"][name="ids[]"]').forEach(
                    el => el.remove());

                // Tambahkan input hidden baru dari yang dipilih
                const checkedCheckboxes = document.querySelectorAll('input[name="ids[]"]:checked');
                checkedCheckboxes.forEach(function(checkbox) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'ids[]';
                    hiddenInput.value = checkbox.value;
                    bulkDeleteForm.appendChild(hiddenInput);
                });

                Swal.fire({
                    title: "Hapus Barang Terpilih?",
                    text: "Semua barang yang kamu pilih akan dihapus permanen.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#9ca3af",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal",
                    customClass: {
                        confirmButton: 'rounded-full px-4 py-2',
                        cancelButton: 'rounded-full px-4 py-2'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        bulkDeleteForm.submit();
                    }
                });
            });
        });
    </script>
@endsection
