<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();

        return view("modulos.productos.index", compact("productos"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("modulos.productos.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_por_unidad' => 'nullable',
            'unidad_de_medida_mercadeo' => 'required|in:g,kg,ml,L,x1,x12',
            'unidad_de_medida_produccion' => 'required|in:g,kg,ml,L,x1,x12',
            'imagen' => 'nullable|image',
        ]);

        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->unidad_de_medida_mercadeo = $request->input('unidad_de_medida_mercadeo');
        $producto->unidad_de_medida_produccion = $request->input('unidad_de_medida_produccion');
        $producto->precio_por_unidad = $request->input('precio_por_unidad');

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = $path;
        }

        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
