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
        Schema::create('laboratorios', function (Blueprint $table) {
            $table->id('id_lab');
            $table->unsignedBigInteger('id_perfil'); // Campo para la clave foránea
            $table->string('name_lab'); // Ejemplo de campo adicional
            $table->string('ubicacion_lab');
            $table->string('cant_pc');
            $table->string('d_internet');
            $table->string('detalles_lab')->nullable();;
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('id_perfil')->references('id_perfil')->on('perfil_institucion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratorios');
    }
};
