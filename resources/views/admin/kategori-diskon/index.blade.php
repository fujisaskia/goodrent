@extends('layouts/admin')

@section('title', 'Kategori Diskon GoodRent')

@section('content')

    <div class="mx-auto p-2">
        <h2 class="flex space-x-3 text-2xl md:text-3xl font-bold mb-4 items-center justify-center md:justify-start">
            <i class="fa-solid fa-box-open text-emerald-800"></i>
            <span>Kategori Diskon</span>
        </h2>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row justify-between mb-4">
                <form method="GET" action="{{ route('kategori-diskon.index') }}">
                    <div class="flex space-x-3 mb-2 md:mb-0">
                        <input type="search" name="search" value="{{ request('search') }}"
                            placeholder="Cari Kategori Diskon"
                            class="border p-3 rounded-lg w-60 focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                        <button type="submit"
                            class="py-3 px-4 bg-emerald-600 rounded-full text-white focus:scale-95 duration-300">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
                <div class="flex justify-end gap-3">
                    {{-- Tombol Hapus Semua (default: hidden) --}}
                    <form action="{{ route('kategori-diskon.destroySelected') }}" method="POST" id="bulk-delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" id="bulk-delete-btn"
                            class="bg-red-700 hover:bg-red-800 text-white p-3 rounded-lg items-center focus:scale-95 duration-300 hidden transition-all ease-in-out">
                            <i class="fa-solid fa-trash"></i>
                            <span>Hapus Semua</span>
                        </button>
                    </form>
                    <div class="flex justify-end">
                        <button onclick="openModalTambahKategoriDiskon()"
                            class="bg-green-700 hover:bg-green-800 flex space-x-2 text-white p-3 rounded-lg items-center focus:scale-95 duration-300">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tambah Kategori</span>
                        </button>

                        {{-- Modal Tambah Data diskon  --}}
                        @include('admin.kategori-diskon.create')
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto lg:overflow-visible">
                <table class="w-full border-collapse border rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-500 text-white uppercase">
                            <th class="p-3"><input type="checkbox" id="select_all"></th>
                            <th class="p-3">No</th>
                            <th class="p-3">Nama Kategori</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategoriDiskons as $kategori)
                            <tr class="border-b text-center hover:bg-gray-50">
                                <td><input type="checkbox" name="ids[]" value="{{ $kategori->id }}" class="checkbox-item">
                                </td>
                                <td class="p-3">
                                    {{ $loop->iteration + ($kategoriDiskons->currentPage() - 1) * $kategoriDiskons->perPage() }}
                                </td>
                                <td class="p-3">{{ $kategori->nama }}</td>
                                <td class="p-3">
                                    @if ($kategori->status == 'Draft')
                                        <span
                                            class="bg-yellow-200 text-yellow-800 font-semibold py-1 px-3 rounded-full text-xs">Draf</span>
                                    @else
                                        <span
                                            class="bg-green-200 text-green-800 font-semibold py-1 px-3 rounded-full text-xs">Public</span>
                                    @endif
                                </td>
                                <td class="p-3 flex items-center justify-center gap-2">
                                    {{-- button edit --}}
                                    <button
                                        class="btn-edit-kategori-diskon bg-yellow-500 hover:bg-yellow-600 shadow-md shadow-yellow-300 hover:shadow-none focus:scale-95 duration-300 
                                        text-white py-2 px-2.5 rounded-full"
                                        title="Edit Kategori"
                                        onclick="openModalEditKategoriDiskon(this.dataset.id)" data-id="{{ $kategori->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    {{-- button hapus --}}
                                    <form action="{{ route('kategori-diskon.destroy', $kategori->id) }}" method="POST"
                                        id="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        @include('components.crud.delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-gray-500">
                                    Tidak ada data kategori barang.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal edit --}}
        @include('admin.kategori-diskon.edit', ['kategori' => $kategori])
        {{-- Pagination --}}
        <div class="flex justify-center mt-5">
            {{ $kategoriDiskons->links('vendor.pagination.custom') }}
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

        // membuka modal tambah diskon
        function openModalTambahKategoriDiskon() {
            let overlay = document.getElementById('modal-overlay-tambah-kategori-diskon');
            let modal = document.getElementById('modal-tambah-kategori-diskon');

            // Tampilkan overlay
            overlay.classList.remove('hidden');

            // Beri jeda untuk animasi
            setTimeout(() => {
                modal.classList.remove('scale-95', 'opacity-0');
                modal.classList.add('scale-100', 'opacity-100');
            }, 50);

            document.body.classList.add('overflow-hidden'); // Mencegah scroll saat modal terbuka
        }

        // menutup modal tambah diskon
        function closeModalTambahKategoriDiskon() {
            let modal = document.getElementById('modal-tambah-kategori-diskon');
            let overlay = document.getElementById('modal-overlay-tambah-kategori-diskon');

            // Tambahkan animasi keluar
            modal.classList.add('scale-95', 'opacity-0');
            modal.classList.remove('scale-100', 'opacity-100');

            // Tunggu animasi selesai sebelum menyembunyikan modal
            setTimeout(() => {
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');

                // Kosongkan semua input dalam form jika ada
                const form = modal.querySelector('form');
                if (form) {
                    form.reset(); // Reset form untuk mengosongkan field
                }
            }, 300); // Sesuai durasi transisi (300ms)
        }

        // membuka modal edit diskon
        // document.querySelectorAll('.btn-edit-kategori-diskon').forEach(button => {
        //     button.addEventListener('click', function() {
        //         const itemId = this.getAttribute('data-kategori-id');
        //         openModalEditKategoriDiskon(itemId);
        //     });
        // });

        // function openModalEditKategoriDiskon(id) {
        //     let overlay = document.getElementById('modal-overlay-edit-kategori-diskon');
        //     let modal = document.getElementById('modal-edit-kategori-diskon');

        //     // Bisa juga tambahkan logika untuk menampilkan data sesuai id

        //     overlay.classList.remove('hidden');
        //     setTimeout(() => {
        //         modal.classList.remove('scale-95', 'opacity-0');
        //         modal.classList.add('scale-100', 'opacity-100');
        //     }, 50);

        //     document.body.classList.add('overflow-hidden');
        // }

        // // menutup modal edit diskon
        // function closeModalEditKategoriDiskon() {
        //     let modal = document.getElementById('modal-edit-kategori-diskon');
        //     let overlay = document.getElementById('modal-overlay-edit-kategori-diskon');

        //     // Tambahkan animasi keluar
        //     modal.classList.add('scale-95', 'opacity-0');
        //     modal.classList.remove('scale-100', 'opacity-100');

        //     // Tunggu animasi selesai sebelum menyembunyikan modal
        //     setTimeout(() => {
        //         overlay.classList.add('hidden');
        //         document.body.classList.remove('overflow-hidden');
        //     }, 300); // Sesuai dengan durasi transition (300ms)
        // }

        document.addEventListener('DOMContentLoaded', function() {
            const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
            const bulkDeleteForm = document.getElementById('bulk-delete-form');
            const checkboxes = document.querySelectorAll('input[name="ids[]"]');
            const selectAll = document.getElementById('select_all');

            // Fungsi untuk toggle tombol hapus
            function toggleBulkDeleteButton() {
                const selectedCount = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
                if (selectedCount > 1) {
                    bulkDeleteBtn.classList.remove('hidden');
                } else {
                    bulkDeleteBtn.classList.add('hidden');
                }
            }

            // Checkbox "Pilih Semua"
            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = selectAll.checked;
                    });
                    toggleBulkDeleteButton();
                });
            }

            // Setiap checkbox individu
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', toggleBulkDeleteButton);
            });

            // Jalankan sekali saat halaman dimuat
            toggleBulkDeleteButton();

            // Event klik tombol "Hapus Semua"
            bulkDeleteBtn.addEventListener('click', function(e) {
                e.preventDefault();

                // Hapus input hidden sebelumnya
                document.querySelectorAll('#bulk-delete-form input[name="ids[]"]:not(:checked)').forEach(
                    el => el.remove());

                // Tambahkan input hidden dari checkbox yang dicek
                const checkedCheckboxes = document.querySelectorAll('input[name="ids[]"]:checked');
                checkedCheckboxes.forEach(function(checkbox) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'ids[]';
                    hiddenInput.value = checkbox.value;
                    bulkDeleteForm.appendChild(hiddenInput);
                });

                // SweetAlert konfirmasi
                Swal.fire({
                    title: "Hapus Data Terpilih?",
                    text: "Semua data yang kamu pilih akan dihapus dan tidak bisa dikembalikan.",
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
