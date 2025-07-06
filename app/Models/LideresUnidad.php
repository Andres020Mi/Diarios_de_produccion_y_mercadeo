<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LideresUnidad extends Model
{
    protected $table = "lideres_unidads";

    protected $fillable = [
        "unidades_productiva_id",
        "user_id",
    ];

    public function unidadesProductivas()
    {
        return $this->belongsTo(unidadesProductiva::class, 'unidades_productiva_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
