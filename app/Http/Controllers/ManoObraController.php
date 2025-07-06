<?php

namespace App\Http\Controllers;

use App\Models\ManoObra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManoObraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        
        $manoObras = ManoObra::all();



        return view("modulos.manoObras.index",compact("manoObras"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("modulos.manoObras.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      


        $request->validate([
            'cedula' => 'required|integer',
            'nombre' => 'required|string',
            'imagen' => 'nullable|image',
        ]);

        // funcion only obtiene los campos del equest y crea un array relacional con los nombres de los inputs y sus valores
        $data = $request->only(['cedula', 'nombre']);

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('mano_obras', 'public');
            $data['imagen'] = $path;
        }

        ManoObra::create($data);

        return redirect()->route('manoObras.index')->with('success', 'Mano de obra creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ManoObra $manoObra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManoObra $manoObra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManoObra $manoObra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManoObra $id)
    {

        $manoObra = $id;
        // Elimina la imagen asociada si existe
        if ($manoObra->imagen && Storage::disk('public')->exists($manoObra->imagen)) {
            Storage::disk('public')->delete($manoObra->imagen);
        }

        // Elimina el registro de la base de datos
        $manoObra->delete();

        return redirect()->route('manoObras.index')->with('success', 'Mano de obra eliminada exitosamente.');
    }
}
