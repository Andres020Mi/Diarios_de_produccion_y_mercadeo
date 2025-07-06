@extends('layouts.app')

@section('title')
   Asignacion de lideres de unidad
@endsection

@section('content')

    {{-- Iconos Heroicons por CDN --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/heroicons/2.1.5/outline.min.css" rel="stylesheet">

    <div class="p-6 max-w-7xl mx-auto space-y-6">
        {{-- ✅ Alertas mejoradas --}}
        @if (session('success'))
            <div class="alert alert-success flex justify-between items-center shadow-md rounded-lg">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="btn btn-sm btn-circle btn-ghost hover:bg-success/20">
                    <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error flex flex-col gap-3 shadow-md rounded-lg">
                <div class="flex items-center gap-2 font-bold">
                    <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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

        {{-- ✅ Tabla mejorada --}}
        <div class="bg-base-100 p-6 rounded-xl shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h1 class="text-2xl font-bold text-base-content">Lideres de unidades productivas</h1>
                    <p class="text-sm text-base-content/70">Lista de los Lideres de unidades</p>
                </div>
                <a href="{{ route('lideresUnidads.create') }}" class="btn btn-primary btn-md gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Crear lider de unidad 
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full text-sm">
                    <thead>
                        <tr class="text-base-content/80">
                            <th class="text-left">ID</th>
                            <th class="text-left">Nombre</th>
                            <th class="text-left">Email</th>
                            <td class="text-left">Nombre de Unidad productiva</td>
                            <td class="text-left">Descripcion de unidad productiva</td>
                            <th class="text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lideresUnidads as $lideresUnida)
                            <tr class="hover:bg-base-200">
                                <td>{{ $lideresUnida->id }}</td>
                                <td>{{ $lideresUnida->user->name }}</td>
                                 <td>{{ $lideresUnida->user->email }}</td>
                              
                             
                                    <td>{{ $lideresUnida->unidadesProductivas->nombre }}</td>
                                      <td class="max-w-xs whitespace-normal break-words text-sm text-base-content">
                                    {{ $lideresUnida->unidadesProductivas->descripcion }}
                                </td>
                                <td class="flex gap-2">
                                    {{-- Ver --}}
                                    <button onclick="showModal({{ $lideresUnida->id }})"
                                        class="btn btn-sm btn-info btn-square tooltip" data-tip="Ver unidad productiva">
                                        <svg class="w-4 h-4 text-info-content" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                    {{-- Editar --}}
                                    <a href="{{ route('lideresUnidads.edit', $lideresUnida->id) }}"
                                        class="btn btn-sm btn-warning btn-square tooltip" data-tip="Editar unidad productiva">
                                        <svg class="w-4 h-4 text-warning-content" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    {{-- Eliminar --}}
                                    <button onclick="showDeleteModal({{ $lideresUnida->id }})"
                                        class="btn btn-sm btn-error btn-square tooltip" data-tip="Eliminar unidad productiva">
                                        <svg class="w-4 h-4 text-error-content" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4">
                                            </path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-6 text-base-content/50">No hay unidades productivas
                                    registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ✅ Modal DaisyUI para mostrar detalles (mejorada) --}}
    <dialog id="modal-unidad" class="modal">
        <div class="modal-box max-w-lg flex flex-col max-h-[80vh] bg-base-100 rounded-xl shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-lg text-base-content">Detalles de la Unidad Productiva</h3>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost hover:bg-base-200">
                        <svg class="w-5 h-5 text-base-content" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </form>
            </div>
            <div id="modal-content" class="flex-1 overflow-y-auto pr-4 space-y-4 text-base-content">
                <!-- Contenido dinámico se inserta aquí -->
            </div>
        </div>
    </dialog>

    {{-- ✅ Modal DaisyUI para confirmación de eliminación --}}
    <dialog id="modal-delete" class="modal">
      <div class="modal-box max-w-md bg-base-100 rounded-xl shadow-lg">
        <div class="flex items-center gap-3 mb-4">
            <svg class="w-6 h-6 text-warning" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="font-bold text-lg text-base-content">¿Eliminar Unidad Productiva?</h3>
        </div>
        <p class="text-base-content/80">¿Estás seguro de que deseas eliminar esta unidad productiva? Esta acción no se puede deshacer.</p>
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

    {{-- ✅ Estilos adicionales --}}
    @section('head')
        <style>
            .modal-box {
                padding: 1.5rem;
                transition: all 0.3s ease;
            }

            .modal-content {
                max-height: calc(80vh - 120px);
            }

            .btn-square {
                padding: 0;
                width: 2.25rem;
                height: 2.25rem;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .table th,
            .table td {
                padding: 0.75rem;
            }

            .alert {
                transition: opacity 0.3s ease;
            }

            .alert button:hover {
                transform: scale(1.05);
            }
        </style>
    @endsection

    {{-- ✅ Scripts para modales --}}
    @section('scripts')
        <script>
            function showModal(id) {
                const modal = document.getElementById('modal-unidad');
                const modalContent = document.getElementById('modal-content');

                modalContent.innerHTML = '<p class="text-base-content/50 animate-pulse">Cargando...</p>';

                fetch(`/unidadesProductiva/${id}`)
                    .then(res => {
                        if (!res.ok) throw new Error('Error al cargar los datos');
                        return res.json();
                    })
                    .then(data => {
                        modalContent.innerHTML = `
                <div class="card card-side bg-base-100 shadow-sm">
                    <figure>
                        <img src="${data.imagen ? `/storage/${data.imagen}` : 'https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp'}"
                             alt="Imagen de Unidad Productiva" class="w-48 h-auto object-cover" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">${data.nombre}</h2>
                        <p>${data.descripcion}</p>
                        <p><span class="font-semibold">Responsable:</span> ${data.responsable}</p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary" onclick="document.getElementById('modal-unidad').close()">Cerrar</button>
                        </div>
                    </div>
                </div>
            `;
                        modal.showModal();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        modalContent.innerHTML =
                            `<p class="text-error font-semibold">Error al cargar los datos de la unidad productiva.</p>`;
                        modal.showModal();
                    });
            }

            function showDeleteModal(id) {
                const modal = document.getElementById('modal-delete');
                const form = document.getElementById('delete-form');
                form.action = `/lideresUnidads/${id}/destroy`;
                modal.showModal();
            }
        </script>
    @endsection

@endsection
