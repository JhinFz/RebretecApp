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
        Schema::create('diagnosticos', function (Blueprint $table) {
            $table->id('id_diag');
            $table->unsignedBigInteger('id_pc'); //lab al que pertenece
            $table->string('diagnostico_detail');
            $table->boolean('estado')->default(false);
            $table->string('msg_admin')->nullable(true);
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('id_pc')->references('id_pc')->on('dispositivos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosticos');
    }
};
