<?php
//   Schema::create('areas_produccions', function (Blueprint $table) {
//             $table->id();
//              $table->string("nombre");
//             $table->text("descripcion");
//             $table->timestamps();
//         });
namespace App\Http\Controllers;

use App\Models\areasProduccion;
use Illuminate\Http\Request;

class AreasProduccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $areasProduccions = areasProduccion::all();

        return view("modulos.areasProduccions.index",compact("areasProduccions"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          return view("modulos.areasProduccions.create"); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        areasProduccion::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('areasProduccions.index')->with('success', 'Área de producción creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(areasProduccion $areasProduccion)
    {
        return response()->json($areasProduccion);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(areasProduccion $areasProduccion)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, areasProduccion $areasProduccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(areasProduccion $id)
    {
        $id->delete();
        return redirect()->route('areasProduccions.index')->with('success', 'Área de producción eliminada exitosamente.');
    }
}
