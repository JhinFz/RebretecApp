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
        Schema::create('perfil_tecnico', function (Blueprint $table) {
            $table->id("id_perfil");
            $table->unsignedBigInteger('user_id');
            $table->string('telefono');
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil_tecnico');
    }
};
