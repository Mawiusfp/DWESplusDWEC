<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloqueEntrenamiento extends Model
{

    // Must match the sql table-name
    protected $table = 'bloque_entrenamiento';
    
    // These are the columns
    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo',
        'duracion_estimada',
        'potencia_pct_min',
        'potencia_pct_max',
        'pulso_pct_max',
        'pulso_reserva_pct',
        'comentario'
    ];
    
    /* These are the datatypes that are NOT strings
    
    example with different datatypes:

        protected $casts = [
            'mydate'                => 'datetime',
            'myfloat'               => 'float',
            'myint'                 => 'integer'
        ];

    */
    protected $casts = [
        'potencia_pct_min' => 'float',
        'potencia_pct_max' => 'float',
        'pulso_pct_max' => 'float',
        'pulso_reserva_pct' => 'float',
    ];

    /**
     * Relationship with SesionEntrenamiento via the pivot table 'sesion_bloque'
     */
    public function sesiones()
    {
        return $this->belongsToMany(
            SesionEntrenamiento::class, 
            'sesion_bloque', 
            'id_bloque_entrenamiento', 
            'id_sesion_entrenamiento'
        )->withPivot('orden', 'repeticiones');
    }
}