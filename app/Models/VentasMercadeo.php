<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VentasMercadeo extends Model
{
    protected $table = "ventas_mercadeos";
    protected $fillable = [
        "producto_id",
        "cantidad",
        "fecha_registro",
        "valor_venta",
        "precio_por_unidad",
    ];

    protected $cast = [
        "fecha_registro" => "datatime",
    ];

    /**
     * Get the user that owns the VentasMercadeo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function producto(): BelongsTo
    {
        return $this->belongsTo(producto::class, 'producto_id', 'id');
    }
}
