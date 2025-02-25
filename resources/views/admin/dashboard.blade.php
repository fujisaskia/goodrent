@extends('layouts/admin')

@section('title', 'Dashboard Utama')

@section('content')

<div class="mx-auto p-2">
    <!-- Header -->
    <div class="bg-yellow-50 border-2 border-yellow-100 rounded-xl shadow-md p-6 flex items-center justify-between h-36">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Selamat Datang, Admin</h1>
            <p class="text-gray-600">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsam, facere?</p>
        </div>
        <img src="{{ asset('images/dashboard-illustration.png') }}" alt="Illustration" class="w-40">
    </div>

    <!-- Overview Section -->
    <h2 class="text-lg font-semibold text-gray-700 mt-6">Overview</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-8 mt-4">
        <!-- Card 1 -->
        <div class="bg-emerald-500 text-black shadow-lg p-6 rounded-lg flex items-center">
            <div class="mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M9 21V3m4 18V3m4 18V3"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-3xl font-bold">83%</h3>
                <p class="text-sm">Open Rate</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-yellow-50 text-black shadow-lg p-6 rounded-lg flex items-center">
            <div class="mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-3xl font-bold">77%</h3>
                <p class="text-sm">Complete</p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-green-500 text-black shadow-lg p-6 rounded-lg flex items-center">
            <div class="mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-3xl font-bold">91</h3>
                <p class="text-sm">Unique Views</p>
            </div>
        </div>

    </div>

    <!-- Chart Section -->
    <h2 class="text-lg font-semibold text-gray-700 mt-6 mb-5">Performance Chart</h2>
    <div class="bg-white p-6 rounded-lg shadow-md lg:max-w-2xl h-96">
        <canvas id="performanceChart"></canvas>
    </div>
</div>

<script>
     document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('performanceChart').getContext('2d');
        var performanceChart = new Chart(ctx, {
            type: 'line', // Line Chart
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Open Rate (%)',
                    data: [70, 75, 80, 85, 90, 83], 
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 2
                }, {
                    label: 'Completion (%)',
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
                    y: { beginAtZero: true }
                }
            }
        });
    });
</script>

@endsection
    
