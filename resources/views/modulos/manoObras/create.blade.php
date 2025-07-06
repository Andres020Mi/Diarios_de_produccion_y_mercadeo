@extends('layouts.app')

@section('head')
    <!-- Heroicons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/heroicons/2.1.5/outline.min.css" rel="stylesheet">
@endsection

@section('title', 'Trabajadores')

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
                        <h1 class="card-title text-2xl">Registrar a un trabajador</h1>
                        <p class="text-sm text-base-content/70">Formulario para registrar a un trabajador</p>
                    </div>
                    <a href="{{ route('manoObras.index') }}" class="btn btn-secondary btn-md gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                        Cancelar
                    </a>
                </div>

                <form action="{{ route('manoObras.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-control mb-4">
                        <label class="label block" for="nombre">
                            <span class="label-text font-medium">Nombre *</span>
                        </label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                            class="input input-bordered w-full max-w-md" required>
                    </div>

                    <div class="form-control mb-4">
                        <label class="label block" for="cedula">
                            <span class="label-text font-medium">cedula</span>
                        </label>
                        <input type="number" id="cedula" name="cedula" value="{{ old('cedula') }}"
                            class="input input-bordered w-full max-w-md">
                    </div>

                    <div class="form-control mb-4">
                        <label class="label block" for="imagen">
                            <span class="label-text font-medium">Foto del trabajador</span>
                        </label>
                        <input type="file" id="imagen" name="imagen" accept="image/*"
                            class="file-input file-input-bordered w-full max-w-md" onchange="previewImage(event)">
                        <div class="mt-3">
                            <img id="preview" src="#" alt="Previsualización" class="rounded shadow max-w-xs hidden"
                                style="max-height: 180px;">
                        </div>
                    </div>

                    <div class="card-actions justify-end mt-4">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>

                <script>
                    function previewImage(event) {
                        const input = event.target;
                        const preview = document.getElementById('preview');
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                                preview.classList.remove('hidden');
                            }
                            reader.readAsDataURL(input.files[0]);
                        } else {
                            preview.src = '#';
                            preview.classList.add('hidden');
                        }
                    }
                </script>
            </div>
        </div>
    </div>
@endsection
