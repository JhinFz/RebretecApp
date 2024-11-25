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
            $table->id()->nullable();
            $table->string('nombres')->nullable(true);
            $table->string('mail')->nullable(true);
            $table->string('lugar')->nullable(true);
            $table->string('telefono')->nullable(true);
            $table->date('fecha')->nullable(true);
            $table->time('hora')->nullable(true);
            $table->string('p_recoleccion')->nullable(true);
            $table->string('d_equipos')->nullable(true);
            $table->string('tipo')->nullable(true);
            $table->string('marca')->nullable(true);
            $table->string('modelo')->nullable(true);
            $table->string('serie')->nullable(true);
            $table->string('detalle')->nullable(true);
            $table->string('observaciones')->nullable(true);
            $table->string('n_donante')->nullable(true);
            $table->string('ci')->nullable(true);
            $table->string('t_ingeniero')->nullable(true);
            $table->timestamp('fecha de creación')->default(DB::raw('NOW()'));;
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
