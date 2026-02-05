<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSesionBloqueTable extends Migration
{
    public function up()
    {
        Schema::create('sesion_bloque', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sesion_entrenamiento')->constrained('sesion_entrenamiento')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_bloque_entrenamiento')->constrained('bloque_entrenamiento')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('orden');
            $table->integer('repeticiones')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sesion_bloque');
    }
}
