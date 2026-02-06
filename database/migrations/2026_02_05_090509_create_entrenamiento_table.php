<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrenamientoTable extends Migration
{
    public function up()
    {
        Schema::create('entrenamientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ciclista_id')->constrained('ciclistas')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('bicicleta_id')->constrained('bicicletas')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('sesion_entrenamiento_id')->nullable()->constrained('sesiones_entrenamiento')->nullOnDelete()->cascadeOnUpdate();
            $table->dateTime('fecha');
            $table->time('duracion');
            $table->decimal('kilometros', 6, 2);
            $table->string('recorrido', 150);
            $table->integer('pulso_medio')->nullable();
            $table->integer('pulso_max')->nullable();
            $table->integer('potencia_media')->nullable();
            $table->integer('potencia_normalizada');
            $table->decimal('velocidad_media', 5, 2);
            $table->decimal('puntos_estres_tss', 6, 2)->nullable();
            $table->decimal('factor_intensidad_if', 4, 3)->nullable();
            $table->integer('ascenso_metros')->nullable();
            $table->string('comentario', 255)->nullable();

            $table->index(['ciclista_id', 'fecha'], 'idx_ciclista_fecha');
            $table->index('fecha', 'idx_fecha');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entrenamientos');
    }
}
