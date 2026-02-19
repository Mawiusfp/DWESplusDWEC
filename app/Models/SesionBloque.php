<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesionBloque extends Model
{
    // Specify the table name
    protected $table = 'sesion_bloque';
    
    // These are the columns that can be mass assigned
    protected $fillable = [
        'id_sesion_entrenamiento',
        'id_bloque_entrenamiento',
        'orden',
        'repeticiones'
    ];
    
    // Define the datatypes for castable columns
    protected $casts = [
        'id_sesion_entrenamiento'   => 'integer',
        'id_bloque_entrenamiento'   => 'integer',
        'orden'                     => 'integer',
        'repeticiones'              => 'integer'
    ];

    /**
     * Relationship with SesionEntrenamiento
     */
    public function sesion()
    {
        return $this->belongsTo(
            SesionEntrenamiento::class, 
            'id_sesion_entrenamiento'
        );
    }

    /**
     * Relationship with BloqueEntrenamiento
     */
    public function bloque()
    {
        return $this->belongsTo(
            BloqueEntrenamiento::class, 
            'id_bloque_entrenamiento'
        );
    }
}