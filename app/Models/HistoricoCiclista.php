<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricoCiclista extends Model
{
    protected $table = 'historico_ciclista';
    
    protected $fillable = [
        'id_ciclista',
        'fecha',
        'peso',
        'ftp',
        'pulso_max',
        'pulso_reposo',
        'potencia_max',
        'grasa_corporal',
        'vo2max',
        'comentario'
    ];
    
    protected $casts = [
        'id_ciclista' => 'integer',
        'fecha' => 'date',
        'peso' => 'decimal:2',
        'ftp' => 'integer',
        'pulso_max' => 'integer',
        'pulso_reposo' => 'integer',
        'potencia_max' => 'integer',
        'grasa_corporal' => 'decimal:2',
        'vo2max' => 'decimal:1'
    ];

    /**
     * Relationship with Ciclista
     */
    public function ciclista()
    {
        return $this->belongsTo(Ciclista::class, 'id_ciclista');
    }
}