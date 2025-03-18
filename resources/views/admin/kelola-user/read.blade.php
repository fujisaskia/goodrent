<div id="modal-overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center px-4 z-50">
    <div id="userModal"
        class="w-full max-w-2xl md:w-[600px] mx-auto p-8 bg-white rounded-lg shadow-lg border border-gray-400 md:border-none transform scale-95 opacity-0 transition-all duration-300">
        <h1 class="text-lg md:text-xl font-semibold mb-6 pb-2 border-b text-center">Tambah User Baru</h1>
        <div class="bg-white shadow-lg rounded-2xl p-6 w-96">
            <div class="flex justify-between items-center border-b pb-3">
                <h2 class="text-xl font-semibold text-gray-800">Detail Pengguna</h2>
                <button onclick="closeUserModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <div class="mt-4 space-y-3">
                <div class="flex items-center space-x-4">
                    <img src="/path/to/user-image.jpg" alt="User Avatar" class="w-16 h-16 rounded-full shadow-md">
                    <div>
                        <h3 class="text-lg font-medium text-gray-800">John Doe</h3>
                        <p class="text-gray-500">johndoe@example.com</p>
                    </div>
                </div>
                <div class="border-t pt-3 space-y-2 text-gray-700">
                    <div class="flex justify-between">
                        <span class="font-medium">Nomor Telepon:</span>
                        <span>+62 812 3456 7890</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Status Pelanggan:</span>
                        <span class="px-2 py-1 text-white text-sm rounded-lg"
                            :class="{'bg-blue-500': status_pelanggan === 'Aktif', 'bg-yellow-500': status_pelanggan === 'Suspended', 'bg-red-500': status_pelanggan === 'Banned'}">
                            Aktif
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Terakhir Online:</span>
                        <span>2024-03-15 12:45:30</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>