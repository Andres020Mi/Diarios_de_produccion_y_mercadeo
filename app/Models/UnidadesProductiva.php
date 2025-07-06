<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadesProductiva extends Model
{
    protected $table = 'unidades_productivas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'area_produccion_id',
    ];

    public function areaProduccion()
    {
        return $this->belongsTo(areasProduccion::class, 'area_produccion_id');
    }
}
