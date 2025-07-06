@extends('layouts.app')


@section("title","Prueba")

@section("content")

<button class="btn btn-primary">Primario</button>
<button class="btn btn-secondary">Secundario</button>
<button class="btn btn-accent">Acento</button>
<button class="btn btn-neutral">Neutral</button>
 <div id="content" class="space-y-6 overflow-auto">
                    <!-- Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="card bg-base-100 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title">Usuarios Activos</h2>
                                <p class="text-3xl font-bold">1,234</p>
                                <div class="card-actions justify-end">
                                    <button class="btn btn-custom-primary ">Ver Detalles</button>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-base-100 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title">Ventas Hoy</h2>
                                <p class="text-3xl font-bold">$5,678</p>
                                <div class="card-actions justify-end">
                                    <button class="btn btn-primary">Ver Reporte</button>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-base-100 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title">Nuevos Pedidos</h2>
                                <p class="text-3xl font-bold">89</p>
                                <div class="card-actions justify-end">
                                    <button class="btn btn-primary btn-sm">Ver Pedidos</button>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-base-100 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title">Tareas Pendientes</h2>
                                <p class="text-3xl font-bold">12</p>
                                <div class="card-actions justify-end">
                                    <button class="btn btn-primary btn-sm">Ver Tareas</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title">Últimos Usuarios</h2>
                            <div class="overflow-x-auto">
                                <table class="table w-full">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Juan Pérez</td>
                                            <td>juan@example.com</td>
                                            <td><span class="badge badge-success">Activo</span></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm">Editar</button>
                                                    <button class="btn btn-sm btn-error">Eliminar</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>María Gómez</td>
                                            <td>maria@example.com</td>
                                            <td><span class="badge badge-warning">Pendiente</span></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm">Editar</button>
                                                    <button class="btn btn-sm btn-error">Eliminar</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Alerts and Timeline -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="card bg-base-100 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title">Notificaciones</h2>
                                <div class="alert alert-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>Nuevo usuario registrado.</span>
                                </div>
                                <div class="alert alert-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 w-6 h-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    <span>Servidor con alta carga.</span>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-base-100 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title">Línea de Tiempo</h2>
                                <ul class="timeline">
                                    <li>
                                        <div class="timeline-start">2025-07-01</div>
                                        <div class="timeline-middle">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                        </div>
                                        <div class="timeline-end timeline-box">Sistema actualizado</div>
                                        <hr/>
                                    </li>
                                    <li>
                                        <hr/>
                                        <div class="timeline-start">2025-07-02</div>
                                        <div class="timeline-middle">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                        </div>
                                        <div class="timeline-end timeline-box">Nuevo módulo añadido</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Form -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title">Añadir Usuario</h2>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Nombre</span>
                                </label>
                                <input type="text" placeholder="Nombre" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Email</span>
                                </label>
                                <input type="email" placeholder="Email" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Rol</span>
                                </label>
                                <select class="select select-bordered">
                                    <option>Administrador</option>
                                    <option>Usuario</option>
                                    <option>Invitado</option>
                                </select>
                            </div>
                            <div class="form-control mt-6">
                                <button class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
@endsection