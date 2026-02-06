<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoCiclistaTable extends Migration
{
    public function up()
    {
        Schema::create('historicos_ciclistas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ciclista_id')->constrained('ciclistas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('fecha');
            $table->decimal('peso', 5, 2)->nullable();
            $table->integer('ftp')->nullable();
            $table->integer('pulso_max')->nullable();
            $table->integer('pulso_reposo')->nullable();
            $table->integer('potencia_max')->nullable();
            $table->decimal('grasa_corporal', 4, 2)->nullable();
            $table->decimal('vo2max', 4, 1)->nullable();
            $table->string('comentario', 255)->nullable();

            $table->unique(['ciclista_id', 'fecha'], 'uq_ciclista_fecha');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('historicos_ciclistas');
    }
}
