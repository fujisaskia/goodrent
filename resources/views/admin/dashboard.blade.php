@extends('layouts/admin')

@section('title', 'GoodRent | Dashboard Utama')

@section('content')

    <div class="mx-auto p-2">
        <!-- Header -->
        <div
            class="flex flex-col md:flex-row bg-gradient-to-r from-emerald-500 to-teal-400 rounded-xl shadow-lg p-6 items-center h-72 justify-between md:h-48 relative overflow-hidden">

            <div class="flex-1 relative">
                <h1 class="text-3xl md:text-4xl text-white font-bold">Selamat Datang, {{ Auth::user()->name }} 👋</h1>
                <p class="text-base text-gray-100 max-w-md mt-1">Kelola data dengan mudah dan pastikan semuanya berjalan dengan baik.</p>
            </div>

            <div class="flex">
                <!-- Ilustrasi Dekoratif -->
                <div class="absolute -bottom-5 -right-5 w-40 h-40 bg-emerald-700 rounded-full opacity-30"></div>
                <!-- Ilustrasi Dashboard -->
                <img src="{{ asset('assets/dashboard.png') }}" alt="Illustration Dashboard"
                    class="animate-smallbounce w-60 md:w-72 drop-shadow-lg">
            </div>
        </div>


        <!-- Overview Section -->
        <h2 class="text-lg font-semibold text-gray-700 mt-6">Overview</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            <!-- Card 1 - Emerald -->
            <div
                class="bg-gradient-to-r from-emerald-500 to-emerald-700 text-white shadow-xl shadow-emerald-200 p-6 rounded-2xl flex items-center group">
                <div class="mr-4 p-3 bg-white/20 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-12 group-hover:scale-110 duration-200">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-4xl font-extrabold" data-target="83">0</h3>
                    <p class="text-lg opacity-80">Pemesanan</p>
                </div>
            </div>

            <!-- Card 2 - Purple -->
            <div
                class="bg-gradient-to-r from-purple-500 to-purple-700 text-white shadow-xl  shadow-purple-300 p-6 rounded-2xl flex items-center group">
                <div class="mr-4 p-3 bg-white/20 rounded-full">
                    <img src="{{ asset('assets/image.png') }}" alt="uang-rupiah"
                        class="w-14 lg:w-12 h-auto opacity-85 group-hover:scale-110 duration-200">
                </div>
                <div>
                    <h3 class="text-4xl md:text-3xl font-extrabold" data-target="10000000">0</h3>
                    <p class="text-lg opacity-80">Pendapatan</p>
                </div>
            </div>

            <!-- Card 3 - Blue -->
            <div
                class="bg-gradient-to-r from-blue-500 to-blue-700 text-white shadow-xl shadow-blue-300 p-6 rounded-2xl flex items-center group">
                <div class="mr-4 p-3 bg-white/20 rounded-full">
                    <x-iconsax-bol-profile-2user class="w-12 h-auto group-hover:scale-110 duration-200" />
                </div>
                <div>
                    <h3 class="text-4xl font-extrabold" data-target="91">0</h3>
                    <p class="text-lg opacity-80">Pelanggan</p>
                </div>
            </div>
        </div>



        <!-- Chart Section -->
        <h2 class="text-lg font-semibold text-gray-700 mt-6 mb-5">Performance Chart</h2>

        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Diagram 1 -->
            <div class="bg-white p-6 rounded-lg shadow-md lg:w-2/3 h-96">
                <canvas id="performanceChart"></canvas>
            </div>

            <!-- Pie Chart -->
            <div class="bg-white p-6 rounded-lg shadow-md lg:w-1/3 h-96">
                <canvas id="pieChart"></canvas>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll("h3[data-target]");
            counters.forEach(counter => {
                let target = +counter.getAttribute("data-target");
                let count = 0;
                let speed = target / 100;
                let updateCount = () => {
                    if (count < target) {
                        count += speed;
                        counter.innerText = Math.floor(count);
                        requestAnimationFrame(updateCount);
                    } else {
                        counter.innerText = target.toLocaleString();
                    }
                };
                updateCount();
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('performanceChart').getContext('2d');
            var performanceChart = new Chart(ctx, {
                type: 'line', // Line Chart
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Penyewa (%)',
                        data: [70, 75, 80, 85, 90, 83],
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 2
                    }, {
                        label: 'Pendapatan (%)',
                        data: [60, 65, 72, 78, 80, 77],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        // Pie Chart
        const ctx2 = document.getElementById('pieChart').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Completed', 'Pending', 'Failed'],
                datasets: [{
                    data: [60, 30, 10],
                    backgroundColor: ['#4CAF50', '#FF9800', '#F44336']
                }]
            }
        });
    </script>

@endsection
