<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("descripcion");
            $table->enum('unidad_de_medida_mercadeo', ['g', 'kg', 'ml', 'L', 'x1', 'x12'])->nullable();
            $table->enum('unidad_de_medida_produccion', ['g', 'kg', 'ml', 'L', 'x1', 'x12'])->nullable();
            $table->string("imagen");
            $table->decimal("precio_por_unidad", 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
