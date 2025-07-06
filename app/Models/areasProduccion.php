<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class areasProduccion extends Model
{
       protected $table = "areas_produccions";

    protected $fillable = [
        "nombre",
        "descripcion"
    ];

    public function unidadesProductivas()
    {
        return $this->hasMany(UnidadesProductiva::class, 'area_produccion_id');
    }


    public function areaProduccion()
    {
        return $this->belongsTo(AreasProduccion::class, 'area_produccion_id');
    }
}
