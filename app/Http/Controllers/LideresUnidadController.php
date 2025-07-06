<?php

namespace App\Http\Controllers;

use App\Models\LideresUnidad;
use App\Models\UnidadesProductiva;
use App\Models\User;
use Illuminate\Http\Request;

class LideresUnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lideresUnidads = LideresUnidad::with("unidadesProductivas","user")->get();


        return view("modulos.lideresUnidads.index", compact("lideresUnidads"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $unidadesProductivas = UnidadesProductiva::all();
        return view("modulos.lideresUnidads.create", compact("unidadesProductivas"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cedula' => 'required|exists:users,cedula',
            'unidades_productiva_id' => 'required|exists:unidades_productivas,id',
        ]);




        $user = User::where("cedula", $request->cedula)->first();

        $existGestorArea = LideresUnidad::where("user_id", $user->id)
            ->where("unidades_productiva_id", $request->unidades_productiva_id)
            ->first();


        if ($existGestorArea) {
            return back()->with("error", "Este lidere de unidad  ya esta asignado a la unidad productiva que seleccionaste");
        }



        LideresUnidad::create([
            'user_id' => (int) $user->id,
            'unidades_productiva_id' => (int) $request->unidades_productiva_id,

        ]);

        return redirect()->route('gestoresAreas.index')->with('success', 'Conexión guardada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LideresUnidad $lideresUnidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LideresUnidad $lideresUnidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LideresUnidad $lideresUnidad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LideresUnidad $lideresUnidad)
    {
        //
    }
}
