<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GestoresArea extends Model
{
    protected $table = 'gestores_areas';

    protected $fillable = [
        "area_produccion_id",
        "user_id",
        "fecha_registro",
    ];


    public function areaProduccion()
    {
        return $this->belongsTo(AreasProduccion::class, 'area_produccion_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
