@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Selamat datang, {{ optional(session('admin_data'))->name ?? 'Admin' }}</h2>
    <hr class="mb-6">

    <h4 class="text-lg font-semibold mb-2">📊 Grafik Pendaftaran Member per Bulan</h4>
    <div class="bg-white p-6 rounded-xl shadow-md">
        <canvas id="memberChart" height="100"></canvas>
    </div>

    <script>
        const labels = {!! json_encode($chartData->pluck('bulan')) !!};
        const data = {!! json_encode($chartData->pluck('total')) !!};

        const ctx = document.getElementById('memberChart').getContext('2d');

        // Gradien warna biru modern
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.8)');   // biru terang
        gradient.addColorStop(1, 'rgba(59, 130, 246, 0.2)');   // biru muda transparan

        const memberChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Member',
                    data: data,
                    backgroundColor: gradient,
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1,
                    borderRadius: 10,
                    barThickness: 40,
                }]
            },
            options: {
                responsive: true,
                animation: {
                    duration: 1500,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#ffffff',
                        bodyColor: '#d1d5db',
                        padding: 10,
                        callbacks: {
                            label: function(context) {
                                return `Jumlah: ${context.parsed.y}`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e5e7eb'
                        },
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
