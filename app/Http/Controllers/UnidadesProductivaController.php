<?php

namespace App\Http\Controllers;

use App\Models\areasProduccion;
use App\Models\UnidadesProductiva;
use Illuminate\Http\Request;

class UnidadesProductivaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unidadesProductivas = UnidadesProductiva::with("areaProduccion")->get();
        return view("modulos.unidadesProductivas.index",compact("unidadesProductivas"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areasProduccions = areasProduccion::all();


        return view("modulos.unidadesProductivas.create",compact("areasProduccions"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'area_produccion_id' => 'required|exists:areas_produccions,id',
            // Agrega aquí otras reglas de validación según tus campos
        ]);

        UnidadesProductiva::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'area_produccion_id' => $request->area_produccion_id,
            // Agrega aquí otros campos según tu modelo
        ]);

        return redirect()->route('unidadesProductivas.index')->with('success', 'Unidad productiva creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UnidadesProductiva $unidadesProductiva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnidadesProductiva $unidadesProductiva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnidadesProductiva $unidadesProductiva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnidadesProductiva $id)
    {

      
        $id->delete();
        return redirect()->route('unidadesProductivas.index')->with('success', 'Unidad productiva eliminada correctamente.');
    }
}
