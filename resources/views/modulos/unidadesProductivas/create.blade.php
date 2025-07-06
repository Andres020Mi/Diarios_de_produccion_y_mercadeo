@extends('layouts.app')

@section('head')
    <!-- Heroicons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/heroicons/2.1.5/outline.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        .select2-container--default .select2-selection--single {
            @apply border border-base-300 rounded-md bg-base-100 text-base-content h-10 px-3 flex items-center;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            @apply text-base-content flex items-center h-full;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            @apply h-10 flex items-center;
        }

        .select2-container {
            @apply w-full max-w-md;
        }
    </style>
@endsection

@section('title', 'Unidades Productivas Create')

@section('content')
    <div class="p-6 max-w-7xl mx-auto space-y-6">
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

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h1 class="card-title text-2xl">Crear Unidad Productiva</h1>
                        <p class="text-sm text-base-content/70">Formulario para registrar una nueva unidad productiva</p>
                    </div>
                    <a href="{{ route('unidadesProductivas.index') }}" class="btn btn-secondary btn-md gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                        Cancelar
                    </a>
                </div>

                <form action="{{ route('unidadesProductivas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-control mb-4">
                        <label class="label block" for="nombre">
                            <span class="label-text font-medium">Nombre *</span>
                        </label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                            class="input input-bordered w-full max-w-md" required>
                    </div>

                    <div class="form-control mb-4">
                        <label class="label block" for="descripcion">
                            <span class="label-text font-medium">Descripción</span>
                        </label>
                        <input type="text" id="descripcion" name="descripcion" value="{{ old('descripcion') }}"
                            class="input input-bordered w-full max-w-md">
                    </div>

                    <div class="form-control mb-4">
                        <label class="label" for="area_produccion_id">
                            <span class="label-text font-medium">Área de Producción *</span>
                        </label>
                        <div class="max-w-md w-full">
                            <select id="area_produccion_id" name="area_produccion_id" class="select select-bordered w-full"
                                data-placeholder="Seleccione un área" required>
                                <option value="" disabled selected>Seleccione un área</option>
                                @foreach ($areasProduccions as $area)
                                    <option value="{{ $area->id }}"
                                        {{ old('area_produccion_id') == $area->id ? 'selected' : '' }}>
                                        {{ $area->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card-actions justify-end mt-4">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#area_produccion_id').select2({
                placeholder: $('#area_produccion_id').data('placeholder'),
                allowClear: true,
                width: '100%',
                theme: 'default',
                dropdownCssClass: 'border border-base-300 rounded-md bg-base-100 text-base-content'
            });
        });
    </script>
@endsection
