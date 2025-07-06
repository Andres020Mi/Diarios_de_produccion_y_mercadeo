<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class inventarioMercadeo extends Model
{
    protected $table = "inventario_mercadeos";
    
    protected $fillable = [
        "producto_id",
        "cantidad",
        "fecha_ingreso",
    ];

    /**
     * Get the user that owns the inventarioMercadeo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

     protected $cast = [
        "fecha_ingreso" => "datatime",
     ];

    public function producto(): BelongsTo
    {
        return $this->belongsTo(producto::class, 'producto_id', 'id');
    }


}
