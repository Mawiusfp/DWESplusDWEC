<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseTables extends Migration
{
    public function up()
    {
        // 1. Ciclista
        Schema::create('ciclista', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 80);
            $table->string('apellidos', 80);
            $table->date('fecha_nacimiento');
            $table->decimal('peso_base', 5, 2)->nullable();
            $table->integer('altura_base')->nullable();
            $table->string('email', 80)->unique();
            $table->string('password'); // En Laravel será hash (bcrypt)
            $table->timestamps(); // Created_at y updated_at son estándar en Laravel
        });

        // 2. Bloque Entrenamiento
        Schema::create('bloque_entrenamiento', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('descripcion', 255)->nullable();
            $table->enum('tipo', ['rodaje', 'intervalos', 'fuerza', 'recuperacion', 'test']);
            $table->time('duracion_estimada')->nullable();
            $table->decimal('potencia_pct_min', 5, 2)->nullable();
            $table->decimal('potencia_pct_max', 5, 2)->nullable();
            $table->decimal('pulso_pct_max', 5, 2)->nullable();
            $table->decimal('pulso_reserva_pct', 5, 2)->nullable();
            $table->string('comentario', 255)->nullable();
            $table->timestamps();
        });

        // 3. Tipo Componente
        Schema::create('tipo_componente', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->unique();
            $table->string('descripcion', 255)->nullable();
            $table->timestamps();
        });

        // 4. Bicicleta
        Schema::create('bicicleta', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->enum('tipo', ['carretera', 'mtb', 'gravel', 'rodillo']);
            $table->string('comentario', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bicicleta');
        Schema::dropIfExists('tipo_componente');
        Schema::dropIfExists('bloque_entrenamiento');
        Schema::dropIfExists('ciclista');
    }
}