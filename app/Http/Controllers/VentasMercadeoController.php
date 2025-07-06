<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\VentasMercadeo;
use Illuminate\Http\Request;

class VentasMercadeoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = VentasMercadeo::with("producto")->get();
        
      
        return view("modulos.ventasmercadeo.index",compact("ventas"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();

        return view("modulos.ventasMercadeo.create",compact("productos"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


       
        if($request->actualizar_precio){
            $producto =  Producto::find($request->producto_id);
            $producto->precio_por_unidad = $request->nuevo_precio;
        }else{
              $producto =  Producto::find($request->producto_id);
        }

      

          $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
           
        ]);

       VentasMercadeo::create([
            'producto_id' => $request->producto_id,
            'cantidad' => $request->cantidad,
            'fecha_registro' => now()->toDateString(),
             "precio_por_unidad" => $producto->precio_por_unidad,
            "valor_venta" => $producto->precio_por_unidad * $request->cantidad,
        ]);

     

        return redirect()->route('ventasMercadeo.index')->with('success', 'venta registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(VentasMercadeo $ventasMercadeo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VentasMercadeo $ventasMercadeo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VentasMercadeo $ventasMercadeo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VentasMercadeo $ventasMercadeo)
    {
        //
    }
}
