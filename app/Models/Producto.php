<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{


    protected $table = "productos";

    protected $fillable = [
        "nombre",
        "descripcion",
        "unidad_de_medida_produccion",
        "unidad_de_medida_mercadeo",
        "imagen",
        "precio_por_unidad"
    ];


    /**
     * Get all of the comments for the Producto
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventarioMercadeo(): HasMany
    {
        return $this->hasMany(inventarioMercadeo::class, 'producto_id', 'id');
    }
    

    /**
     * Get all of the comments for the Producto
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ventasMercadeo(): HasMany
    {
        return $this->hasMany(ventasMercadeo::class, 'producto_id', 'id');
    }


}
