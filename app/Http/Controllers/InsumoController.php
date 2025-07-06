<?php
//    {{-- Schema::create('insumos', function (Blueprint $table) {
//             $table->id();
//             $table->string('nombre')->unique();
//             $table->string('descripcion')->nullable();
//             $table->enum('unidad_de_medida', ['g', 'kg', 'ml', 'L', 'x1', 'x12'])->nullable();
//             $table->string('imagen')->nullable();
//             $table->timestamps();
//         }); --}}
namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;

class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $insumos = Insumo::all();
        return view("modulos.insumos.index", compact("insumos"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("modulos.insumos.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:insumos,nombre',
            'descripcion' => 'nullable|string',
            'unidad_de_medida' => 'nullable|in:g,kg,ml,L,x1,x12',
            'imagen' => 'nullable|image',
        ]);

        $data = $request->only(['nombre', 'descripcion', 'unidad_de_medida']);

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('insumos', 'public');
            $data['imagen'] = $path;
        }

        Insumo::create($data);

        return redirect()->route('insumos.index')->with('success', 'Insumo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $insumo = \App\Models\Insumo::find($id);

        if (!$insumo) {
            return response()->json(['message' => 'Insumo no encontrado'], 404);
        }

        return response()->json($insumo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insumo $insumo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Insumo $insumo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insumo $id)
    {
    $id->delete();
    return redirect()->route('insumos.index')->with('success', 'Insumo eliminado correctamente.');
    }
}
