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
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id('id_mant');
            $table->unsignedBigInteger('id_diag'); //lab al que pertenece
            $table->string('actividades');
            $table->boolean('estado_mant')->default(false);
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('id_diag')->references('id_diag')->on('diagnosticos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
