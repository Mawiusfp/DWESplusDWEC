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
            $table->foreignId('bicicleta_id')->constrained('bicicletas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tipo_componente_id')->constrained('tipos_componente')->restrictOnDelete()->cascadeOnUpdate();
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

            $table->index(['bicicleta_id', 'tipo_componente_id', 'activo'], 'idx_componentes_activos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('componentes_bicicleta');
    }
}
