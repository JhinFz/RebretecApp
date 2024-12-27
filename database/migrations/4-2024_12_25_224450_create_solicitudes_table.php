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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id("id_soli");
            $table->unsignedBigInteger('id_perfil'); // Campo para la clave foránea
            $table->string('asunto');
            $table->string('detalles_soli');
            $table->string('estado_soli');
            $table->timestamps();
            $table->timestamp('fecha_aceptacion')->nullable();
            $table->unsignedBigInteger('id_tecnico')->nullable();

            // Definir la clave foránea
            $table->foreign('id_perfil')->references('id_perfil')->on('perfil_institucion');
            $table->foreign('id_tecnico')->references('id_perfil')->on('perfil_tecnico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
