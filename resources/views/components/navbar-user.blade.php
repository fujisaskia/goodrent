    <!-- Navbar -->
    <nav class="fixed top-2 left-0 w-[calc(100%-2rem)] mx-4 bg-white shadow-md p-4 z-50 rounded-lg">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h2 class="text-green-700 font-bold text-lg hidden md:flex">GoodRent</h2>
            @if (request()->is('goodrent/produk'))
                <h3 class="text-green-700 font-bold text-xl md:hidden ">GoodRent</h3>
            @else
                <div class="flex md:hidden  items-center space-x-2 text-xl">
                    <i class="fa-solid fa-chevron-left p-2 cursor-pointer" onclick="window.history.back();"></i>
                    <h2 class="text-green-700 font-bold text-3xl">G</h2>
                </div>
            @endif


            <div class="flex items-center space-x-3 md:space-x-4">
                <a href="/goodrent/cek-keranjang" class="hover:bg-slate-300 rounded-full p-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                </a>
                <div class="relative">
                    <div class="flex items-center space-x-2">
                        <button id="userBtn">
                            <img src="{{ asset('storage/users/' . (Auth::user()->image ?: 'Dummy.png')) }}"
                                alt="User Profile" class="w-10 h-10 rounded-full object-cover">
                        </button>
                    </div>

                    <!-- Dropdown Menu -->
                    <div id="userMenu"
                        class="absolute right-0 mt-2 w-56 text-base md:text-sm bg-white shadow-md border border-gray-300 rounded-lg hidden">
                        <!-- Profil User -->
                        <div class="flex items-center space-x-2 p-4 border-b">
                            <img src="{{ asset('storage/users/' . (Auth::user()->image ?: 'Dummy.png')) }}"
                                alt="Profile Picture" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="py-2 text-base md:text-sm text-gray-700">
                            <a href="{{ route('profile') }}"
                                class="flex space-x-3 items-center px-4 py-2 hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <span>Profil</span>
                            </a>
                            <a href="/goodrent/pemesanan-saya"
                                class="flex space-x-3 items-center px-4 py-2 hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                <span>Pemesanan</span>
                            </a>
                            <a href="/goodrent/profile/alamat"
                                class="flex space-x-3 items-center px-4 py-2 hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                <span>Daftar Alamat</span>
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center space-x-3 px-4 py-2 hover:bg-red-100 mt-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                    </svg>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <script>
        // {{-- membuka menu fitur user di ikon --}}
        const userBtn = document.getElementById('userBtn');
        const userMenu = document.getElementById('userMenu');

        userBtn.addEventListener('click', () => {
            userMenu.classList.toggle('hidden');
        });

        // Klik di luar menu untuk menutup dropdown
        document.addEventListener('click', (event) => {
            if (!userBtn.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });
    </script>
