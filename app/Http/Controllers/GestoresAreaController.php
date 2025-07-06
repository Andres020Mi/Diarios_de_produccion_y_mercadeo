<?php

namespace App\Http\Controllers;

use App\Models\areasProduccion;
use App\Models\GestoresArea;
use App\Models\User;
use Illuminate\Http\Request;

class GestoresAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gestoresAreas = GestoresArea::with("areaProduccion","user")->get();
   
        return view("modulos.gestoresAreas.index",compact("gestoresAreas"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areasProduccions = areasProduccion::all();

        $users = User::all();

        return view("modulos.gestoresAreas.create", compact("areasProduccions", "users"));
      
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


   
        $request->validate([
            'cedula' => 'required|exists:users,cedula',
            'area_produccion_id' => 'required|exists:areas_produccions,id',
        ]);

        


        $user = User::where("cedula", $request->cedula)->first(); 

        $existGestorArea = GestoresArea::where("user_id", $user->id)
    ->where("area_produccion_id", $request->area_produccion_id)
    ->first();


        if($existGestorArea){
            return back()->with("error","Este gestor de area ya esta asignado al area que seleccionaste");
        }



        GestoresArea::create([
            'user_id' => (int) $user->id,
            'area_produccion_id' => (int) $request->area_produccion_id,
            
        ]);

        return redirect()->route('gestoresAreas.index')->with('success', 'Conexión guardada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GestoresArea $gestoresArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GestoresArea $gestoresArea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GestoresArea $gestoresArea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GestoresArea $gestoresArea)
    {
        //
    }
}
