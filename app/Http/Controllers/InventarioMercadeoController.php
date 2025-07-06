<?php

namespace App\Http\Controllers;

use App\Models\inventarioMercadeo;
use App\Models\Producto;
use Illuminate\Http\Request;

class InventarioMercadeoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = inventarioMercadeo::with("producto")->get();

        return view("modulos.inventarioMercadeo.index",compact("productos"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();

        return view("modulos.inventarioMercadeo.create",compact("productos"));
    }

    /**
     * Store a newly created resource in storage.
     */

    //    Schema::create('inventario_mercadeos', function (Blueprint $table) {
    //         $table->id();
    //         $table->unsignedBigInteger('producto_id');
    //         $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
    //         $table->integer("cantidad");
    //         $table->date("fecha_ingreso");
    //         $table->timestamps();
    //     });
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $inv = inventarioMercadeo::create([
            'producto_id' => $request->producto_id,
            'cantidad' => $request->cantidad,
            'fecha_ingreso' => now()->toDateString(),
        ]);

     

        return redirect()->route('inventarioMercadeo.index')->with('success', 'Inventario registrado correctamente.');
    }
   
     

    /**
     * Display the specified resource.
     */
    public function show(inventarioMercadeo $inventarioMercadeo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(inventarioMercadeo $inventarioMercadeo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, inventarioMercadeo $inventarioMercadeo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(inventarioMercadeo $inventarioMercadeo)
    {
        //
    }
}
