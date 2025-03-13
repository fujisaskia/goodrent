    <!-- Footer -->
    <footer class="bg-emerald-600 text-white p-6">
        <div class="max-w-6xl mx-auto justify-between">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pb-6 border-b border-emerald-700">
                {{-- Social Media --}}
                <div class="">
                    <div class="flex space-x-3 items-center mb-4">
                        <img src="{{ asset('assets/profile.jpg') }}" alt="Goodrent Logo" class="w-12 h-12 rounded-full">
                        <h3 class="text-white text-3xl lg:text-2xl font-bold">GoodRent</h3>
                    </div>
                    <span class="text-sm text-gray-100 pr-0 md:pr-8">Sewa PS & Barang Kapan Pun, Dimana Pun! Lorem ipsum
                        dolor sit
                        amet.</span>
                    <div class="flex space-x-4 mt-4">
                        <a href=""
                            class="py-1 px-2 bg-emerald-700 hover:bg-emerald-800 duration-200 hover:scale-105 text-white rounded"><i
                                class="fa-brands fa-instagram"></i></a>
                        <a href=""
                            class="py-1 px-2 bg-emerald-700 hover:bg-emerald-800 duration-200 hover:scale-105 text-white rounded"><i
                                class="fa-brands fa-whatsapp"></i></a>
                        <a href=""
                            class="py-1 px-2 bg-emerald-700 hover:bg-emerald-800 duration-200 hover:scale-105 text-white rounded"><i
                                class="fa-brands fa-twitter"></i></a>
                        <a href=""
                            class="py-1 px-2.5 bg-emerald-700 hover:bg-emerald-800 duration-200 hover:scale-105 text-white rounded"><i
                                class="fa-brands fa-facebook-f"></i></a>
                    </div>
                </div>

                {{-- Kontak --}}
                <div class="text-sm md:text-xs">
                    {{-- kontak --}}
                    <div class="flex space-x-2 items-center mb-5">
                        <i class="fa-solid fa-phone p-1.5 bg-gray-300 rounded-full text-emerald-800"></i>
                        <div class="flex flex-col ">
                            <h5 class="text-gray-200">Telepon</h5>
                            <h4 class="text-white font-semibold">089511223344</h4>
                        </div>
                    </div>
                    {{-- Alamat --}}
                    <div class="flex space-x-2 items-center">
                        <i class="fa-solid fa-location-dot py-1.5 px-2 bg-gray-300 rounded-full text-emerald-800"></i>
                        <div class="flex flex-col">
                            <h5 class="text-gray-200">Alamat</h5>
                            <h4 id="petagoodrent" class="text-white font-semibold pr-0 md:pr-8">SMK Negeri 1 Ciomas, Jl.
                                Raya Laladon, Laladon, Kec. Ciomas, Kabupaten Bogor, Jawa Barat 16610</h4>
                        </div>
                    </div>
                </div>

                {{-- Maps Location --}}
                <div>
                    <h5 class="text-gray-100 font-semibold mb-3">Peta Lokasi</h5>
                    <iframe id="mapFrame" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        class="w-full h-40 rounded">
                    </iframe>
                </div>

            </div>

            <div class="flex flex-col space-y-3 md:flex-row text-center justify-between mt-5 text-xs">
                <h4>&copy; 2025 GoodRent. All rights reserved. Developed By Lorem, ipsum.</h4>
                <!-- Tombol untuk membuka modal -->
                <button onclick="toggleModal(true)" class="hover:underline">
                    <h4>Syarat & Ketentuan</h4>
                </button>

                <!-- Modal -->
                <div id="modal"
                    class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 invisible transition-opacity duration-300">
                    <!-- Modal Content -->
                    <div id="modalContent"
                        class="bg-white rounded-lg shadow-lg p-6 w-11/12 md:w-1/2 scale-90 transition-transform duration-300">
                        <!-- Header -->
                        <div class="flex justify-between items-center border-b pb-3">
                            <h3 class="text-lg font-semibold text-gray-800">📜 Syarat & Ketentuan Rental PS</h3>
                            <button onclick="toggleModal(false)" class="text-gray-500 hover:text-red-500">
                                ✖
                            </button>
                        </div>

                        <!-- Konten Modal -->
                        <div class="mt-4 text-gray-700 text-start text-base md:text-sm">
                            <ul class="list-decimal list-inside space-y-2">
                                <li>Wajib dengan 2 jaminan aktif & asli (KTP, KTM, SIM, STNK, Kartu Keluarga).</li>
                                <li>Pembayaran diawal ketika pengambilan unit.</li>
                                <li>Denda keterlambatan pengembalian 5K-10K/jam.</li>
                                <li><strong>DILARANG MENGHUBUNGKAN PS4 KE WIFI.</strong></li>
                                <li>Jika ada kerusakan, biaya ditanggung penyewa.</li>
                                <li>Jika ingin menambah waktu, wajib langsung transfer. Jika tidak, akan dihitung
                                    sebagai denda.</li>
                                <li>Untuk booking dari jauh hari, dikenakan DP sebesar 50%.</li>
                            </ul>
                        </div>


                        <!-- Footer -->
                        <div class="mt-5 border-t pt-3 flex justify-end">
                            <button onclick="toggleModal(false)"
                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                Tutup
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </footer>

    {{-- Script untuk Mengupdate Peta --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let petaGoodrent = document.getElementById("petagoodrent").innerText.trim();
            let mapUrl = "https://www.google.com/maps?q=" + encodeURIComponent(petaGoodrent) + "&output=embed";
            document.getElementById("mapFrame").src = mapUrl;
        });

        function toggleModal(show) {
            let modal = document.getElementById("modal");
            let modalContent = document.getElementById("modalContent");

            if (show) {
                modal.classList.remove("opacity-0", "invisible");
                modal.classList.add("opacity-100", "visible");
                modalContent.classList.remove("scale-90");
                modalContent.classList.add("scale-100");
            } else {
                modal.classList.remove("opacity-100", "visible");
                modal.classList.add("opacity-0", "invisible");
                modalContent.classList.remove("scale-100");
                modalContent.classList.add("scale-90");
            }
        }
    </script>
