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
        Schema::create('unidades_productivas', function (Blueprint $table) {
            $table->id();
             $table->string("nombre");
            $table->text("descripcion");
            $table->unsignedBigInteger('area_produccion_id');
            $table->foreign('area_produccion_id')->references('id')->on('areas_produccions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades_productivas');
    }
};
