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
        Schema::create('contactos', function (Blueprint $table) {
            
            $table->id()->nullable();
            $table->string('instname')->nullable(true);
            $table->string('name')->nullable(true);
            $table->string('correo')->nullable(true);
            $table->string('telefono')->nullable(true);
            $table->string('direccion')->nullable(true);
            $table->string('mensaje')->nullable(true);
            $table->timestamp('fecha')->default(DB::raw('NOW()'));;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactos');
    }
};
