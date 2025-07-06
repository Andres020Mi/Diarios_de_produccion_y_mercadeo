@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-center mb-6">Diarios de Producción</h1>

    <div class="card bg-base-100 shadow-xl mb-6">
        <div class="card-body">
            <h3 class="text-xl font-semibold">Selección de Usuario</h3>
            <div class="flex gap-2 justify-center">
                @foreach(['Supervisor', 'Trabajador', 'Gerente'] as $role)
                    <button wire:click="setUser('{{ $role }}')" class="btn btn-primary">{{ $role }}</button>
                @endforeach
            </div>
            <div class="text-center mt-2">Usuario actual: {{ $currentUser ?? 'Ninguno' }}</div>
        </div>
    </div>

    <div class="card bg-base-100 shadow-xl mb-6">
        <div class="card-body">
            <label for="weekSelect" class="label">Seleccionar Semana:</label>
            <div class="flex gap-2">
                <select wire:model="currentWeek" wire:change="loadWeekData" id="weekSelect" class="select select-bordered w-full">
                    <option value="">Selecciona una semana</option>
                    @foreach($weeks as $week)
                        <option value="{{ $week }}">{{ $week }}</option>
                    @endforeach
                </select>
                <button wire:click="createNewWeek" class="btn btn-secondary">Nueva Semana</button>
            </div>
        </div>
    </div>

    <div class="card bg-base-100 shadow-xl mb-6">
        <div class="card-body">
            <h2 class="text-2xl font-semibold">Producción</h2>
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Valor Unitario</th>
                            <th>Valor Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productionData as $index => $row)
                            <tr>
                                <td><input type="date" wire:model="productionData.{{ $index }}.date" wire:change="updateRow('production', {{ $index }})" class="input input-bordered w-full"></td>
                                <td><input type="text" wire:model="productionData.{{ $index }}.item" wire:change="updateRow('production', {{ $index }})" class="input input-bordered w-full"></td>
                                <td><input type="number" min="0" wire:model="productionData.{{ $index }}.quantity" wire:change="updateRow('production', {{ $index }})" class="input input-bordered w-full"></td>
                                <td><input type="number" min="0" step="0.01" wire:model="productionData.{{ $index }}.unitValue" wire:change="updateRow('production', {{ $index }})" class="input input-bordered w-full"></td>
                                <td>${{ number_format($row['quantity'] * $row['unitValue'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-lg font-bold mt-4">Total: ${{ number_format($productionTotal, 2) }}</div>
            <button wire:click="addProductionRow" class="btn btn-primary mt-4">Agregar Fila</button>
            <div class="mt-4">
                <x-wireui-checkbox label="De Acuerdo" wire:model="validations.production.{{ $currentUser }}" wire:change="validateTable('production')" class="checkbox checkbox-primary" />
                <div class="mt-2">
                    <span class="font-semibold">Validaciones:</span>
                    @foreach($validations['production'] ?? [] as $role => $status)
                        <div>{{ $role }}: {{ $status ? 'De Acuerdo' : 'No De Acuerdo' }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="card bg-base-100 shadow-xl mb-6">
        <div class="card-body">
            <h2 class="text-2xl font-semibold">Insumos Consumidos</h2>
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Insumo</th>
                            <th>Cantidad</th>
                            <th>Valor Unitario</th>
                            <th>Valor Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliesData as $index => $row)
                            <tr>
                                <td><input type="date" wire:model="suppliesData.{{ $index }}.date" wire:change="updateRow('supplies', {{ $index }})" class="input input-bordered w-full"></td>
                                <td><input type="text" wire:model="suppliesData.{{ $index }}.item" wire:change="updateRow('supplies', {{ $index }})" class="input input-bordered w-full"></td>
                                <td><input type="number" min="0" wire:model="suppliesData.{{ $index }}.quantity" wire:change="updateRow('supplies', {{ $index }})" class="input input-bordered w-full"></td>
                                <td><input type="number" min="0" step="0.01" wire:model="suppliesData.{{ $index }}.unitValue" wire:change="updateRow('supplies', {{ $index }})" class="input input-bordered w-full"></td>
                                <td>${{ number_format($row['quantity'] * $row['unitValue'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-lg font-bold mt-4">Total: ${{ number_format($suppliesTotal, 2) }}</div>
            <button wire:click="addSuppliesRow" class="btn btn-primary mt-4">Agregar Fila</button>
            <div class="mt-4">
                <x-wireui-checkbox label="De Acuerdo" wire:model="validations.supplies.{{ $currentUser }}" wire:change="validateTable('supplies')" class="checkbox checkbox-primary" />
                <div class="mt-2">
                    <span class="font-semibold">Validaciones:</span>
                    @foreach($validations['supplies'] ?? [] as $role => $status)
                        <div>{{ $role }}: {{ $status ? 'De Acuerdo' : 'No De Acuerdo' }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="card bg-base-100 shadow-xl mb-6">
        <div class="card-body">
            <h2 class="text-2xl font-semibold">Mano de Obra Utilizada</h2>
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Trabajador</th>
                            <th>Horas</th>
                            <th>Valor por Hora</th>
                            <th>Valor Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laborData as $index => $row)
                            <tr>
                                <td><input type="date" wire:model="laborData.{{ $index }}.date" wire:change="updateRow('labor', {{ $index }})" class="input input-bordered w-full"></td>
                                <td><input type="text" wire:model="laborData.{{ $index }}.item" wire:change="updateRow('labor', {{ $index }})" class="input input-bordered w-full"></td>
                                <td><input type="number" min="0" wire:model="laborData.{{ $index }}.quantity" wire:change="updateRow('labor', {{ $index }})" class="input input-bordered w-full"></td>
                                <td><input type="number" min="0" step="0.01" wire:model="laborData.{{ $index }}.unitValue" wire:change="updateRow('labor', {{ $index }})" class="input input-bordered w-full"></td>
                                <td>${{ number_format($row['quantity'] * $row['unitValue'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-lg font-bold mt-4">Total: ${{ number_format($laborTotal, 2) }}</div>
            <button wire:click="addLaborRow" class="btn btn-primary mt-4">Agregar Fila</button>
            <div class="mt-4">
                <x-wireui-checkbox label="De Acuerdo" wire:model="validations.labor.{{ $currentUser }}" wire:change="validateTable('labor')" class="checkbox checkbox-primary" />
                <div class="mt-2">
                    <span class="font-semibold">Validaciones:</span>
                    @foreach($validations['labor'] ?? [] as $role => $status)
                        <div>{{ $role }}: {{ $status ? 'De Acuerdo' : 'No De Acuerdo' }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="text-xl font-bold text-right">Gran Total: ${{ number_format($grandTotal, 2) }}</div>
@endsection