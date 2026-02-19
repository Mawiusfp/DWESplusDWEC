<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrenamiento extends Model
{
    protected $table = 'entrenamiento';
    
    protected $fillable = [
        'id_ciclista',
        'id_bicicleta',
        'id_sesion',
        'fecha',
        'duracion',
        'kilometros',
        'recorrido',
        'pulso_medio',
        'pulso_max',
        'potencia_media',
        'potencia_normalizada',
        'velocidad_media',
        'puntos_estres_tss',
        'factor_intensidad_if',
        'ascenso_metros',
        'comentario'
    ];
    
    protected $casts = [
        'id_ciclista' => 'integer',
        'id_bicicleta' => 'integer',
        'id_sesion' => 'integer',
        'fecha' => 'datetime',
        'kilometros' => 'decimal:2',
        'potencia_media' => 'integer',
        'potencia_normalizada' => 'integer',
        'velocidad_media' => 'decimal:2',
        'puntos_estres_tss' => 'decimal:2',
        'factor_intensidad_if' => 'decimal:3',
        'ascenso_metros' => 'integer'
    ];

    /**
     * Relationship with Ciclista
     */
    public function ciclista()
    {
        return $this->belongsTo(Ciclista::class, 'id_ciclista');
    }

    /**
     * Relationship with Bicicleta
     */
    public function bicicleta()
    {
        return $this->belongsTo(Bicicleta::class, 'id_bicicleta');
    }

    /**
     * Relationship with SesionEntrenamiento
     */
    public function sesion()
    {
        return $this->belongsTo(SesionEntrenamiento::class, 'id_sesion');
    }
}