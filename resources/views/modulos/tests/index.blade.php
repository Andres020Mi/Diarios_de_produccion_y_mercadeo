@php

$insumos = collect([
    (object) [
        'id' => 1,
        'nombre' => 'Cemento',
        'descripcion' => 'Cemento Portland de alta resistencia',
        'unidad_de_medida' => 'Saco',
        'weekly_cost' => 250.75,
        'imagen' => 'insumos/cemento.jpg'
    ],
    (object) [
        'id' => 2,
        'nombre' => 'Fertilizante',
        'descripcion' => 'Fertilizante nitrogenado para cultivos',
        'unidad_de_medida' => 'Kilogramo',
        'weekly_cost' => 180.50,
        'imagen' => 'insumos/fertilizante.jpg'
    ],
    (object) [
        'id' => 3,
        'nombre' => 'Tubería PVC',
        'descripcion' => 'Tubería de PVC de 2 pulgadas',
        'unidad_de_medida' => 'Metro',
        'weekly_cost' => 320.00,
        'imagen' => null
    ],
    (object) [
        'id' => 4,
        'nombre' => 'Pintura',
        'descripcion' => 'Pintura acrílica blanca',
        'unidad_de_medida' => 'Litro',
        'weekly_cost' => 210.25,
        'imagen' => 'insumos/pintura.jpg'
    ]
]);

$weeklyLaborData = [
    'labels' => ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
    'datasets' => [
        [
            'label' => 'Costo Mano de Obra ($)',
            'data' => [1200, 1500, 1300, 1700],
            'borderColor' => 'hsl(var(--p))',
            'backgroundColor' => 'hsl(var(--p) / 0.2)',
            'fill' => true,
            'tension' => 0.4
        ]
    ]
];

$weeklyInsumoData = [
    'labels' => ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
    'datasets' => [
        [
            'label' => 'Costo Insumos ($)',
            'data' => [800, 1000, 900, 1200],
            'backgroundColor' => 'hsl(var(--s))',
            'borderColor' => 'hsl(var(--s))',
            'borderWidth' => 1
        ]
    ]
];

$totalLaborCost = array_sum($weeklyLaborData['datasets'][0]['data']);
$totalInsumoCost = array_sum($weeklyInsumoData['datasets'][0]['data']);

@endphp

@extends('layouts.app')

@section('head')
    <!-- Heroicons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/heroicons/2.1.5/outline.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        .modal-box {
            @apply p-6 transition-all duration-300 ease-in-out;
        }
        .modal-content {
            @apply max-h-[calc(80vh-120px)];
        }
        .btn-square {
            @apply p-0 w-9 h-9 flex items-center justify-center;
        }
        .table th,
        .table td {
            @apply px-3 py-3;
        }
        .alert {
            @apply transition-opacity duration-300;
        }
        .alert button:hover {
            @apply scale-105;
        }
        .chart-container {
            @apply relative w-full max-w-md mx-auto;
        }
        .stat-card {
            @apply card bg-base-100 shadow-lg p-4;
        }
    </style>
@endsection

@section('title', 'sistemas de costos')

@section('content')
    <div class="p-6 max-w-7xl mx-auto space-y-6">
        <!-- Success Alert -->
        @if (session('success'))
            <div class="alert alert-success flex justify-between items-center shadow-md rounded-lg">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="btn btn-sm btn-circle btn-ghost hover:bg-success/20">
                    <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        <!-- Error Alert -->
        @if ($errors->any())
            <div class="alert alert-error flex flex-col gap-3 shadow-md rounded-lg">
                <div class="flex items-center gap-2 font-bold">
                    <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Se encontraron errores:</span>
                </div>
                <ul class="list-disc list-inside ml-4 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button onclick="this.closest('.alert').remove()" class="btn btn-sm btn-outline btn-error self-end">
                    Cerrar
                </button>
            </div>
        @endif

        <!-- Dashboard Section -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h1 class="card-title text-2xl">Consumo Semanal</h1>
                        <p class="text-sm text-base-content/70">Resumen de costos de mano de obra e insumos por semana</p>
                    </div>
                    <a href="{{ route('insumos.create') }}" class="btn btn-primary btn-md gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Crear Insumo
                    </a>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="stat-card">
                        <div class="stat">
                            <div class="stat-title">Total Costo Mano de Obra</div>
                            <div class="stat-value text-primary">${{ number_format($totalLaborCost, 2) }}</div>
                            <div class="stat-desc">Últimas 4 semanas</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat">
                            <div class="stat-title">Total Costo Insumos</div>
                            <div class="stat-value text-secondary">${{ number_format($totalInsumoCost, 2) }}</div>
                            <div class="stat-desc">Últimas 4 semanas</div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Labor Cost Chart -->
                    <div class="chart-container">
                        <h3 class="text-lg font-semibold mb-2">Costo Mano de Obra Semanal</h3>
                        <canvas id="laborChart"></canvas>
                    </div>
                    <!-- Insumo Cost Chart -->
                    <div class="chart-container">
                        <h3 class="text-lg font-semibold mb-2">Costo Insumos Semanal</h3>
                        <canvas id="insumoChart"></canvas>
                    </div>
                </div>

                <!-- Insumos Table -->
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full text-sm">
                        <thead>
                            <tr class="text-base-content/80">
                                <th class="text-left">ID</th>
                                <th class="text-left">Nombre</th>
                                <th class="text-left">Descripción</th>
                                <th class="text-left">Unidad</th>
                                <th class="text-left">Costo Semanal</th>
                                <th class="text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($insumos as $insumo)
                                <tr class="hover:bg-base-200">
                                    <td>{{ $insumo->id }}</td>
                                    <td>{{ $insumo->nombre }}</td>
                                    <td class="max-w-xs whitespace-normal break-words text-sm text-base-content">
                                        {{ $insumo->descripcion }}
                                    </td>
                                    <td>{{ $insumo->unidad_de_medida }}</td>
                                    <td>${{ number_format($insumo->weekly_cost ?? 0, 2) }}</td>
                                    <td class="flex gap-2">
                                        <!-- View Button -->
                                        <button onclick="showModal({{ $insumo->id }})"
                                            class="btn btn-sm btn-info btn-square tooltip" data-tip="Ver insumo">
                                            <svg class="w-4 h-4 text-info-content" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                        <!-- Edit Button -->
                                        <a href="{{ route('insumos.edit', $insumo->id) }}"
                                            class="btn btn-sm btn-warning btn-square tooltip" data-tip="Editar insumo">
                                            <svg class="w-4 h-4 text-warning-content" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <!-- Delete Button -->
                                        <button onclick="showDeleteModal({{ $insumo->id }})"
                                            class="btn btn-sm btn-error btn-square tooltip" data-tip="Eliminar insumo">
                                            <svg class="w-4 h-4 text-error-content" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4"></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-6 text-base-content/50">No hay insumos registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- View Modal -->
        <dialog id="modal-insumo" class="modal">
            <div class="modal-box max-w-lg flex flex-col max-h-[80vh] bg-base-100 rounded-xl shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-lg text-base-content">Detalles del Insumo</h3>
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost hover:bg-base-200">
                            <svg class="w-5 h-5 text-base-content" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </form>
                </div>
                <div id="modal-content" class="flex-1 overflow-y-auto pr-4 space-y-4 text-base-content">
                    <!-- Dynamic content inserted here -->
                </div>
            </div>
        </dialog>

        <!-- Delete Modal -->
        <dialog id="modal-delete" class="modal">
            <div class="modal-box max-w-md bg-base-100 rounded-xl shadow-lg">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-6 h-6 text-warning" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="font-bold text-lg text-base-content">¿Eliminar Insumo?</h3>
                </div>
                <p class="text-base-content/80">¿Estás seguro de que deseas eliminar este insumo? Esta acción no se puede deshacer.</p>
                <div class="modal-action mt-6 flex justify-end gap-2">
                    <form method="dialog">
                        <button class="btn btn-outline btn-sm">Cancelar</button>
                    </form>
                    <form id="delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error btn-sm">Eliminar</button>
                    </form>
                </div>
            </div>
        </dialog>
    </div>
@endsection

@section('scripts')
    <script>
        // Mock data for charts (replace with actual data from controller)
        const weeklyLaborData = {
            labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
            datasets: [{
                label: 'Costo Mano de Obra ($)',
                data: [1200, 1500, 1300, 1700],
                borderColor: 'hsl(var(--p))', // DaisyUI primary
                backgroundColor: 'hsl(var(--p) / 0.2)',
                fill: true,
                tension: 0.4
            }]
        };

        const weeklyInsumoData = {
            labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
            datasets: [{
                label: 'Costo Insumos ($)',
                data: [800, 1000, 900, 1200],
                backgroundColor: 'hsl(var(--s))', // DaisyUI secondary
                borderColor: 'hsl(var(--s))',
                borderWidth: 1
            }]
        };

        // Labor Chart
        new Chart(document.getElementById('laborChart'), {
            type: 'line',
            data: weeklyLaborData,
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, labels: { color: 'hsl(var(--bc))' } },
                    tooltip: { backgroundColor: 'hsl(var(--b1))', titleColor: 'hsl(var(--bc))', bodyColor: 'hsl(var(--bc))' }
                },
                scales: {
                    x: { ticks: { color: 'hsl(var(--bc))' } },
                    y: { ticks: { color: 'hsl(var(--bc))' }, beginAtZero: true }
                }
            }
        });

        // Insumo Chart
        new Chart(document.getElementById('insumoChart'), {
            type: 'bar',
            data: weeklyInsumoData,
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, labels: { color: 'hsl(var(--bc))' } },
                    tooltip: { backgroundColor: 'hsl(var(--b1))', titleColor: 'hsl(var(--bc))', bodyColor: 'hsl(var(--bc))' }
                },
                scales: {
                    x: { ticks: { color: 'hsl(var(--bc))' } },
                    y: { ticks: { color: 'hsl(var(--bc))' }, beginAtZero: true }
                }
            }
        });

        // Modal Functions
        function showModal(id) {
            const modal = document.getElementById('modal-insumo');
            const modalContent = document.getElementById('modal-content');
            modalContent.innerHTML = '<p class="text-base-content/50 animate-pulse">Cargando...</p>';
            fetch(`/insumos/${id}`)
                .then(res => {
                    if (!res.ok) throw new Error('Error al cargar los datos');
                    return res.json();
                })
                .then(data => {
                    modalContent.innerHTML = `
                        <div class="card card-side bg-base-100 shadow-sm">
                            <figure>
                                <img src="${data.imagen ? `/storage/${data.imagen}` : 'https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp'}"
                                     alt="Imagen de Insumo" class="w-48 h-auto object-cover" />
                            </figure>
                            <div class="card-body">
                                <h2 class="card-title">${data.nombre}</h2>
                                <p>${data.descripcion}</p>
                                <p><span class="font-semibold">Unidad:</span> ${data.unidad_de_medida}</p>
                                <p><span class="font-semibold">Costo Semanal:</span> $${data.weekly_cost ? data.weekly_cost.toFixed(2) : '0.00'}</p>
                                <div class="card-actions justify-end">
                                    <button class="btn btn-primary" onclick="document.getElementById('modal-insumo').close()">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    `;
                    modal.showModal();
                })
                .catch(error => {
                    console.error('Error:', error);
                    modalContent.innerHTML = `<p class="text-error font-semibold">Error al cargar los datos del insumo.</p>`;
                    modal.showModal();
                });
        }

        function showDeleteModal(id) {
            const modal = document.getElementById('modal-delete');
            const form = document.getElementById('delete-form');
            form.action = `/insumos/${id}/destroy`;
            modal.showModal();
        }
    </script>
@endsection