@extends('layouts.app')

@section('title', 'Gráficos del Software Agropecuario')

@section('head')
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.js"></script>
@endsection

@section('content')
    <div class="container mx-auto p-6 space-y-8">
        <h1 class="text-3xl font-bold text-base-content">Gráficos del Software Agropecuario</h1>
        <p class="text-base-content/80">
            Visualiza los datos clave de tu software agropecuario con gráficos interactivos. Los gráficos a continuación son ejemplos de cómo se pueden representar los datos de insumos, productos, trabajadores, y más.
        </p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Bar Chart -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title text-base-content">Comparación de Insumos por Categoría</h2>
                    <canvas id="barChart" class="w-full h-80"></canvas>
                </div>
            </div>

            <!-- Line Chart -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title text-base-content">Producción a lo Largo del Tiempo</h2>
                    <canvas id="lineChart" class="w-full h-80"></canvas>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title text-base-content">Distribución de Trabajadores por Área</h2>
                    <canvas id="pieChart" class="w-full h-80"></canvas>
                </div>
            </div>

            <!-- Doughnut Chart -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title text-base-content">Uso de Unidades Productivas</h2>
                    <canvas id="doughnutChart" class="w-full h-80"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Theme-aware colors for charts
        const getChartColors = () => {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            return {
                background: isDark ? [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ] : [
                    'rgba(255, 99, 132, 0.4)',
                    'rgba(54, 162, 235, 0.4)',
                    'rgba(255, 206, 86, 0.4)',
                    'rgba(75, 192, 192, 0.4)',
                    'rgba(153, 102, 255, 0.4)'
                ],
                border: isDark ? [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ] : [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ],
                grid: isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)',
                text: isDark ? 'rgba(255, 255, 255, 0.9)' : 'rgba(0, 0, 0, 0.9)'
            };
        };

        // Update charts when theme changes
        const updateCharts = () => {
            const colors = getChartColors();

            // Bar Chart
            const barChart = new Chart(document.getElementById('barChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Fertilizantes', 'Pesticidas', 'Semillas', 'Otros'],
                    datasets: [{
                        label: 'Cantidad de Insumos',
                        data: [], // Data will be provided by controller
                        backgroundColor: colors.background,
                        borderColor: colors.border,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: colors.grid },
                            ticks: { color: colors.text }
                        },
                        x: {
                            grid: { color: colors.grid },
                            ticks: { color: colors.text }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: { color: colors.text }
                        }
                    }
                }
            });

            // Line Chart
            const lineChart = new Chart(document.getElementById('lineChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                    datasets: [{
                        label: 'Producción (Toneladas)',
                        data: [], // Data will be provided by controller
                        backgroundColor: colors.background[0],
                        borderColor: colors.border[0],
                        fill: false,
                        tension: 0.4
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: colors.grid },
                            ticks: { color: colors.text }
                        },
                        x: {
                            grid: { color: colors.grid },
                            ticks: { color: colors.text }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: { color: colors.text }
                        }
                    }
                }
            });

            // Pie Chart
            const pieChart = new Chart(document.getElementById('pieChart').getContext('2d'), {
                type: 'pie',
                data: {
                    labels: ['Área 1', 'Área 2', 'Área 3', 'Área 4'],
                    datasets: [{
                        label: 'Trabajadores',
                        data: [], // Data will be provided by controller
                        backgroundColor: colors.background,
                        borderColor: colors.border,
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { color: colors.text }
                        }
                    }
                }
            });

            // Doughnut Chart
            const doughnutChart = new Chart(document.getElementById('doughnutChart').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Unidad 1', 'Unidad 2', 'Unidad 3'],
                    datasets: [{
                        label: 'Uso de Unidades',
                        data: [], // Data will be provided by controller
                        backgroundColor: colors.background,
                        borderColor: colors.border,
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { color: colors.text }
                        }
                    }
                }
            });
        };

        // Initialize charts on page load
        document.addEventListener('DOMContentLoaded', () => {
            updateCharts();
        });

        // Update charts when theme changes
        document.addEventListener('themeChange', () => {
            updateCharts();
        });

        // Trigger themeChange event when theme is toggled
        const originalToggleTheme = toggleTheme;
        toggleTheme = function() {
            originalToggleTheme();
            document.dispatchEvent(new Event('themeChange'));
        };
    </script>
@endsection