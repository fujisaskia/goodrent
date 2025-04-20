@extends('layouts/admin')

@section('title', 'GoodRent | Dashboard Utama')

@section('content')

    <div class="mx-auto p-5 bg-white rounded-xl shadow-md mt-6 mb-6">
        <!-- Header -->
        <div
            class="flex flex-col md:flex-row bg-gradient-to-r from-emerald-500 to-teal-400 rounded-xl shadow-lg p-6 items-center h-72 justify-between md:h-48 relative overflow-hidden">

            <div class="flex-1 relative">
                <h1 class="text-3xl md:text-4xl text-white font-bold">Selamat Datang, {{ Auth::user()->name }} 👋</h1>
                <p class="text-base text-gray-100 max-w-md mt-1">Kelola data dengan mudah dan pastikan semuanya berjalan
                    dengan baik.</p>
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
                    <h3 class="text-4xl font-extrabold" data-target="{{ $jumlahPemesanan }}">0</h3>
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
                    <h3 class="text-4xl md:text-3xl font-extrabold" data-target="{{ $pendapatanBulanIni }}">0</h3>
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
                    <h3 class="text-4xl font-extrabold" data-target="{{ $jumlahPelanggan }}">0</h3>
                    <p class="text-lg opacity-80">Pelanggan</p>
                </div>
            </div>
        </div>



        <!-- Chart Section -->
        <h2 class="text-lg font-semibold text-gray-700 mt-6 mb-5">Performance Chart</h2>

        <div class="flex justify-end mb-4">
            <select id="filterYear" class="border border-gray-300 rounded px-4 py-2">
                <!-- Tahun akan diisi lewat JS -->
            </select>
        </div>

        <div class="flex gap-6">
            <!-- Diagram 1 -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-md w-full h-96">
                <canvas id="performanceChartPemesanan"></canvas>
            </div>

            <!-- Diagram 2 -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-md w-full h-96">
                <canvas id="performanceChartPendapatan"></canvas>
            </div>
        </div>

    </div>

    <script>
        let pemesananChart;
        let pendapatanChart;

        document.addEventListener("DOMContentLoaded", function() {
            const yearSelect = document.getElementById("filterYear");
            const currentYear = new Date().getFullYear();

            fetch('/get-available-years')
                .then(res => res.json())
                .then(years => {
                    years.forEach(year => {
                        const option = document.createElement("option");
                        option.value = year;
                        option.textContent = year;
                        if (year == currentYear) option.selected = true;
                        yearSelect.appendChild(option);
                    });

                    loadAllCharts(currentYear);
                });

            yearSelect.addEventListener("change", () => {
                const selectedYear = yearSelect.value;
                loadAllCharts(selectedYear);
            });
        });

        function loadAllCharts(year) {
            loadPendapatanChart(year);
            loadPemesananChart(year);
        }

        function loadPendapatanChart(year) {
            fetch(`/get-monthly-revenue-data/${year}`)
                .then(res => res.json())
                .then(data => {
                    const ctx = document.getElementById('performanceChartPendapatan').getContext('2d');
                    if (pendapatanChart) pendapatanChart.destroy();
                    pendapatanChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Pendapatan Bulanan (Ribu Rupiah)',
                                data: data.data,
                                borderColor: '#a855f7',
                                backgroundColor: 'rgba(78, 115, 223, 0.2)',
                                fill: true,
                                tension: 0.3,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 500,
                                        callback: value => value + 'K'
                                    }
                                }
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: context => 'Rp ' + context.parsed.y.toLocaleString() + 'K'
                                    }
                                }
                            }
                        }
                    });
                });
        }

        function loadPemesananChart(year) {
            fetch(`/get-monthly-data/${year}`)
                .then(res => res.json())
                .then(data => {
                    const ctx = document.getElementById('performanceChartPemesanan').getContext('2d');
                    if (pemesananChart) pemesananChart.destroy();
                    pemesananChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Pemesanan Bulanan',
                                data: data.data,
                                borderColor: '#0fb47e',
                                backgroundColor: 'rgba(78, 115, 223, 0.2)',
                                fill: true,
                                tension: 0.3,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1,
                                        callback: value => value
                                    }
                                }
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: context => context.parsed.y.toLocaleString()
                                    }
                                }
                            }
                        }
                    });
                });
        }

        // menghitung angka card ketika halaman dimuat
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
    </script>

@endsection
