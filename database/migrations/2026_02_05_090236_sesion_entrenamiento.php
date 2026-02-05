<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSesionEntrenamientoTable extends Migration
{
    public function up()
    {
        Schema::create('sesion_entrenamiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_plan')->constrained('plan_entrenamiento')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('fecha');
            $table->string('nombre', 100)->nullable();
            $table->string('descripcion', 255)->nullable();
            $table->boolean('completada')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sesion_entrenamiento');
    }
}
