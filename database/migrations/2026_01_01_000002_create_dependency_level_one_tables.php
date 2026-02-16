<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependencyLevelOneTables extends Migration
{
    public function up()
    {
        // Historico Ciclista
        Schema::create('historico_ciclista', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ciclista')->constrained('ciclista')->onDelete('cascade')->onUpdate('cascade');
            $table->date('fecha');
            $table->decimal('peso', 5, 2)->nullable();
            $table->integer('ftp')->nullable();
            $table->integer('pulso_max')->nullable();
            $table->integer('pulso_reposo')->nullable();
            $table->integer('potencia_max')->nullable();
            $table->decimal('grasa_corporal', 4, 2)->nullable();
            $table->decimal('vo2max', 4, 1)->nullable();
            $table->string('comentario', 255)->nullable();
            $table->unique(['id_ciclista', 'fecha']);
            $table->timestamps();
        });

        // Planes de Entrenamiento
        Schema::create('plan_entrenamiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ciclista')->constrained('ciclista')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nombre', 100);
            $table->string('descripcion', 255)->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('objetivo', 100)->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        // Componentes de Bicicleta
        Schema::create('componentes_bicicleta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bicicleta')->constrained('bicicleta')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_tipo_componente')->constrained('tipo_componente')->onDelete('restrict')->onUpdate('cascade');
            $table->string('marca', 50);
            $table->string('modelo', 50)->nullable();
            $table->string('especificacion', 50)->nullable();
            $table->enum('velocidad', ['9v','10v','11v','12v'])->nullable();
            $table->enum('posicion', ['delantera', 'trasera', 'ambas'])->nullable();
            $table->date('fecha_montaje');
            $table->date('fecha_retiro')->nullable();
            $table->decimal('km_actuales', 8, 2)->default(0);
            $table->decimal('km_max_recomendado', 8, 2)->nullable();
            $table->boolean('activo')->default(true);
            $table->string('comentario', 255)->nullable();
            $table->index(['id_bicicleta', 'id_tipo_componente', 'activo'], 'idx_comp_bici_activos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('componentes_bicicleta');
        Schema::dropIfExists('plan_entrenamiento');
        Schema::dropIfExists('historico_ciclista');
    }
}