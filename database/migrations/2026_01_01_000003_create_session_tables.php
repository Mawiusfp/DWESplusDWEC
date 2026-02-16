<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionTables extends Migration
{
    public function up()
    {
        // Sesiones de Entrenamiento
        Schema::create('sesion_entrenamiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_plan')->constrained('plan_entrenamiento')->onDelete('cascade')->onUpdate('cascade');
            $table->date('fecha');
            $table->string('nombre', 100)->nullable();
            $table->string('descripcion', 255)->nullable();
            $table->boolean('completada')->default(false);
            $table->timestamps();
        });

        // Sesión-Bloque (relación muchos a muchos)
        Schema::create('sesion_bloque', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sesion_entrenamiento')->constrained('sesion_entrenamiento')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_bloque_entrenamiento')->constrained('bloque_entrenamiento')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('orden');
            $table->integer('repeticiones')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sesion_bloque');
        Schema::dropIfExists('sesion_entrenamiento');
    }
}