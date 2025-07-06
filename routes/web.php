<?php

use App\Http\Controllers\AreasProduccionController;
use App\Http\Controllers\GestoresAreaController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\InventarioMercadeoController;
use App\Http\Controllers\LideresUnidadController;
use App\Http\Controllers\ManoObraController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UnidadesProductivaController;
use App\Http\Controllers\VentasMercadeoController;
use App\Models\LideresUnidad;
use App\Models\UnidadesProductiva;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/test', function () {
    return view('modulos.tests.index');
})->name('home');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


    // Rutas para administrar insumos
    Route::prefix("insumos")->group(function(){
        Route::get("/",[InsumoController::class,"index"])->name("insumos.index");
        Route::get("/create",[InsumoController::class,"create"])->name("insumos.create");
        Route::post("/store",[InsumoController::class,"store"])->name("insumos.store");
        Route::get('/{id}/edit', [InsumoController::class, 'edit'])->name('insumos.edit');
        Route::post("/{id}/update",[InsumoController::class,"update"])->name("insumos.update");
        Route::delete('/{id}/destroy', [InsumoController::class, 'destroy'])->name('insumos.destroy');
         Route::get('/{id}', [InsumoController::class, 'show'])->name('insumos.show');
    });

    // rutas para administrar las areas de produccion
     Route::prefix("areasProduccions")->group(function(){
        Route::get("/",[AreasProduccionController::class,"index"])->name("areasProduccions.index");
        Route::get("/create",[AreasProduccionController::class,"create"])->name("areasProduccions.create");
        Route::post("/store",[AreasProduccionController::class,"store"])->name("areasProduccions.store");
        Route::get('/{id}/edit', [AreasProduccionController::class, 'edit'])->name('areasProduccions.edit');
        Route::post("/{id}/update",[AreasProduccionController::class,"update"])->name("areasProduccions.update");
        Route::delete('/{id}/destroy', [AreasProduccionController::class, 'destroy'])->name('areasProduccions.destroy');
        Route::get('/{id}', [AreasProduccionController::class, 'show'])->name('areasProduccions.show');
    });

     // rutas para administrar las areas de produccion
     Route::prefix("unidadesProductivas")->group(function(){
        Route::get("/",[UnidadesProductivaController::class,"index"])->name("unidadesProductivas.index");
        Route::get("/create",[UnidadesProductivaController::class,"create"])->name("unidadesProductivas.create");
        Route::post("/store",[UnidadesProductivaController::class,"store"])->name("unidadesProductivas.store");
        Route::get('/{id}/edit', [UnidadesProductivaController::class, 'edit'])->name('unidadesProductivas.edit');
        Route::post("/{id}/update",[UnidadesProductivaController::class,"update"])->name("unidadesProductivas.update");
        Route::delete('/{id}/destroy', [UnidadesProductivaController::class, 'destroy'])->name('unidadesProductivas.destroy');
        Route::get('/{id}', [UnidadesProductivaController::class, 'show'])->name('unidadesProductivas.show');
    });

    // rutas para administrar las areas de produccion
     Route::prefix("gestoresAreas")->group(function(){
        Route::get("/",[GestoresAreaController::class,"index"])->name("gestoresAreas.index");
        Route::get("/create",[GestoresAreaController::class,"create"])->name("gestoresAreas.create");
        Route::post("/store",[GestoresAreaController::class,"store"])->name("gestoresAreas.store");
        Route::get('/{id}/edit', [GestoresAreaController::class, 'edit'])->name('gestoresAreas.edit');
        Route::post("/{id}/update",[GestoresAreaController::class,"update"])->name("gestoresAreas.update");
        Route::delete('/{id}/destroy', [GestoresAreaController::class, 'destroy'])->name('gestoresAreas.destroy');
        Route::get('/{id}', [GestoresAreaController::class, 'show'])->name('gestoresAreas.show');
    });


    
    // rutas para administrar las areas de produccion
     Route::prefix("manoObras")->group(function(){
        Route::get("/",[ManoObraController::class,"index"])->name("manoObras.index");
        Route::get("/create",[ManoObraController::class,"create"])->name("manoObras.create");
        Route::post("/store",[ManoObraController::class,"store"])->name("manoObras.store");
        Route::get('/{id}/edit', [ManoObraController::class, 'edit'])->name('manoObras.edit');
        Route::post("/{id}/update",[ManoObraController::class,"update"])->name("manoObras.update");
        Route::delete('/{id}/destroy', [ManoObraController::class, 'destroy'])->name('manoObras.destroy');
        Route::get('/{id}', [ManoObraController::class, 'show'])->name('manoObras.show');
    });


    Route::prefix("productos")->group(function(){
        Route::get("/",[ProductoController::class,"index"])->name("productos.index");
        Route::get("/create",[ProductoController::class,"create"])->name("productos.create");
        Route::post("/store",[ProductoController::class,"store"])->name("productos.store");
        Route::get('/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
        Route::post("/{id}/update",[ProductoController::class,"update"])->name("productos.update");
        Route::delete('/{id}/destroy', [ProductoController::class, 'destroy'])->name('productos.destroy');
        Route::get('/{id}', [ProductoController::class, 'show'])->name('productos.show');
    });

      Route::prefix("lideresUnidads")->group(function(){
        Route::get("/",[LideresUnidadController::class,"index"])->name("lideresUnidads.index");
        Route::get("/create",[LideresUnidadController::class,"create"])->name("lideresUnidads.create");
        Route::post("/store",[LideresUnidadController::class,"store"])->name("lideresUnidads.store");
        Route::get('/{id}/edit', [LideresUnidadController::class, 'edit'])->name('lideresUnidads.edit');
        Route::post("/{id}/update",[LideresUnidadController::class,"update"])->name("lideresUnidads.update");
        Route::delete('/{id}/destroy', [LideresUnidadController::class, 'destroy'])->name('lideresUnidads.destroy');
        Route::get('/{id}', [LideresUnidadController::class, 'show'])->name('lideresUnidads.show');
    });


          Route::prefix("InventarioMercadeo")->group(function(){
        Route::get("/",[InventarioMercadeoController::class,"index"])->name("inventarioMercadeo.index");
        Route::get("/create",[InventarioMercadeoController::class,"create"])->name("inventarioMercadeo.create");
        Route::post("/store",[InventarioMercadeoController::class,"store"])->name("inventarioMercadeo.store");
        Route::get('/{id}/edit', [InventarioMercadeoController::class, 'edit'])->name('inventarioMercadeo.edit');
        Route::post("/{id}/update",[InventarioMercadeoController::class,"update"])->name("inventarioMercadeo.update");
        Route::delete('/{id}/destroy', [InventarioMercadeoController::class, 'destroy'])->name('inventarioMercadeo.destroy');
        Route::get('/{id}', [InventarioMercadeoController::class, 'show'])->name('inventarioMercadeo.show');
    });

    
          Route::prefix("ventasMercadeo")->group(function(){
        Route::get("/",[VentasMercadeoController::class,"index"])->name("ventasMercadeo.index");
        Route::get("/create",[VentasMercadeoController::class,"create"])->name("ventasMercadeo.create");
        Route::post("/store",[VentasMercadeoController::class,"store"])->name("ventasMercadeo.store");
        Route::get('/{id}/edit', [VentasMercadeoController::class, 'edit'])->name('ventasMercadeo.edit');
        Route::post("/{id}/update",[VentasMercadeoController::class,"update"])->name("ventasMercadeo.update");
        Route::delete('/{id}/destroy', [VentasMercadeoController::class, 'destroy'])->name('ventasMercadeo.destroy');
        Route::get('/{id}', [VentasMercadeoController::class, 'show'])->name('ventasMercadeo.show');
    });
    
    

   


    


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
