<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->id('id_pc');
            $table->unsignedBigInteger('id_lab'); //lab al que pertenece
            // $table->string('tipo')->nullable(true);
            $table->string('marca')->nullable(true);
            $table->string('modelo')->nullable(true);
            $table->string('serie')->nullable(true);
            $table->string('observaciones')->nullable(true);
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('id_lab')->references('id_lab')->on('laboratorios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispositivos');
    }
};
