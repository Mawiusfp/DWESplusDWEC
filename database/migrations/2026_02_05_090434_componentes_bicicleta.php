<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentesBicicletaTable extends Migration
{
    public function up()
    {
        Schema::create('componentes_bicicleta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bicicleta')->constrained('bicicleta')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_tipo_componente')->constrained('tipo_componente')->restrictOnDelete()->cascadeOnUpdate();
            $table->string('marca', 50);
            $table->string('modelo', 50)->nullable();
            $table->string('especificacion', 50)->nullable();
            $table->enum('velocidad', ['9v','10v','11v','12v'])->nullable();
            $table->enum('posicion', ['delantera','trasera','ambas'])->nullable();
            $table->date('fecha_montaje');
            $table->date('fecha_retiro')->nullable();
            $table->decimal('km_actuales', 8, 2)->default(0);
            $table->decimal('km_max_recomendado', 8, 2)->nullable();
            $table->boolean('activo')->default(true);
            $table->string('comentario', 255)->nullable();

            $table->index(['id_bicicleta', 'id_tipo_componente', 'activo'], 'idx_componentes_activos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('componentes_bicicleta');
    }
}
