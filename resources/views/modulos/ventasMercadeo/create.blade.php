@extends('layouts.app')

@section('head')
    <!-- Heroicons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/heroicons/2.1.5/outline.min.css" rel="stylesheet">
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        .input-container {
            @apply relative w-full max-w-md;
        }

        .clear-button {
            @apply absolute right-2 top-1/2 transform -translate-y-1/2;
        }
    </style>
@endsection

@section('title', 'Registro de ventas en mercadeo')

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

        @if (session('error'))
            <div class="alert alert-error flex justify-between items-center shadow-md rounded-lg">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="btn btn-sm btn-circle btn-ghost hover:bg-error/20">
                    <svg class="w-4 h-4 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24"
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
                        <h1 class="card-title text-2xl">Registrar venta</h1>
                        <p class="text-sm text-base-content/70">Formulario para registrar una venta en mercadeo</p>
                    </div>
                    <a href="{{ route('ventasMercadeo.index') }}" class="btn btn-secondary btn-md gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                        Cancelar
                    </a>
                </div>

                <form action="{{ route('ventasMercadeo.store') }}" method="POST">
                    @csrf

                    <div class="form-control mb-4" x-data="dropdown()">
                        <label class="label block" for="area_search">
                            <span class="label-text font-medium">Producto *</span>
                        </label>
                        <div class="input-container">
                            <input id="area_search" x-model="search" @focus="open = true" @click.away="open = false"
                                placeholder="Buscar producto..." class="input input-bordered w-full max-w-md" required />
                            <button x-show="search || selected" @click="clear()"
                                class="clear-button btn btn-ghost btn-sm btn-circle" type="button">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <ul x-show="open"
                            class="mt-2 w-full max-w-md bg-base-100 border border-base-300 rounded-box shadow max-h-60 overflow-y-auto z-50"
                            x-transition>
                            <template x-for="producto in filtered()" :key="producto.id">
                                <li @click="select(producto)" class="px-4 py-2 hover:bg-base-200 cursor-pointer"
                                    x-text="producto.nombre"></li>
                            </template>
                            <li x-show="filtered().length === 0" class="px-4 py-2 text-base-content/50">No encontrado</li>
                        </ul>
                        <input type="hidden" name="producto_id" x-bind:value="selected?.id" required>
                    </div>

                    <div class="form-control mb-4">
                        <label class="label block" for="cantidad">
                            <span class="label-text font-medium">Cantidad a ingresar</span>
                        </label>
                        <input type="number" id="cantidad" name="cantidad" value="{{ old('cantidad') }}"
                            class="input input-bordered w-full max-w-md" min="0" step="0.01" required>
                        <p class="text-sm text-base-content/60 mt-2">
                            Precio estimado total: <span id="precio_total">$0.00</span>
                        </p>
                    </div>

                    {{-- Checkbox para activar el precio --}}
                    <div class="form-control mb-4">
                        <label class="cursor-pointer label flex items-center gap-2">
                            <input type="checkbox" name="actualizar_precio" id="actualizar_precio"
                                class="checkbox checkbox-primary">
                            <span class="label-text">¿Actualizar precio del producto?</span>
                        </label>
                    </div>

                    {{-- Input para nuevo precio oculto al inicio --}}
                    <div class="form-control mb-4" id="precio_container" style="display: none;">
                        <label class="label block" for="nuevo_precio">
                            <span class="label-text font-medium">Nuevo precio</span>
                        </label>
                        <input type="number" name="nuevo_precio" id="nuevo_precio" min="0" step="0.01"
                            class="input input-bordered w-full max-w-md">
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
        function dropdown() {
            return {
                search: '',
                open: false,
                selected: null,
                productos: @json($productos),
                filtered() {
                    return this.productos.filter(producto =>
                        producto.nombre.toLowerCase().includes(this.search.toLowerCase())
                    );
                },
                select(producto) {
                    this.selected = producto;
                    this.search = producto.nombre;
                    this.open = false;
                    window.setSelectedProducto(producto.id); // Trigger price calculation
                },
                clear() {
                    this.search = '';
                    this.selected = null;
                    this.open = false;
                    window.setSelectedProducto(null); // Reset price calculation
                },
                togglePrecioContainer() {
                    const precioContainer = document.getElementById('precio_container');
                    precioContainer.style.display = document.getElementById('actualizar_precio').checked ? 'block' : 'none';
                }
            };
        }

        document.addEventListener('DOMContentLoaded', function() {
            const cantidadInput = document.getElementById('cantidad');
            const totalOutput = document.getElementById('precio_total');
            let selectedProducto = null;
            const productos = @json($productos);

            window.setSelectedProducto = function(id) {
                selectedProducto = id ? productos.find(p => p.id === id) : null;
                calcularTotal();
            };

            cantidadInput.addEventListener('input', calcularTotal);

            function calcularTotal() {
                const cantidad = parseFloat(cantidadInput.value) || 0;
                if (selectedProducto) {
                    const total = cantidad * selectedProducto.precio_por_unidad;
                    totalOutput.textContent = `$${total.toFixed(2)} COP`;
                } else {
                    totalOutput.textContent = '$0.00';
                }
            }
        });

            document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('actualizar_precio');
        const precioContainer = document.getElementById('precio_container');

        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                precioContainer.style.display = 'block';
            } else {
                precioContainer.style.display = 'none';
                document.getElementById('nuevo_precio').value = ''; // limpia si se oculta
            }
        });
    });

    </script>
@endsection
