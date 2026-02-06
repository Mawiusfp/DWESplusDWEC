<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSesionBloqueTable extends Migration
{
    public function up()
    {
        Schema::create('sesion_bloques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sesion_entrenamiento_id')->constrained('sesiones_entrenamiento')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('bloque_entrenamiento_id')->constrained('bloques_entrenamiento')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('orden');
            $table->integer('repeticiones')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sesion_bloques');
    }
}
