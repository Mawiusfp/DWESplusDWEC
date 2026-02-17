<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesionEntrenamiento extends Model
{
    protected $table = 'sesion_entrenamiento';

    protected $fillable = [
        'id_plan',
        'fecha',
        'nombre',
        'descripcion',
        'completada',
    ];

    // 
    protected $casts = [
        'fecha' => 'date',
        'completada' => 'boolean',
    ];


    /* ----- Relationships with other tables ----- */

    /**
     * Relationship: A session belongs to one training plan
     */
    public function plan()
    {
        return $this->belongsTo(PlanEntrenamiento::class, 'id_plan');
    }

    /**
     * Relationship: A session consists of many blocks (Many-to-Many)
     */
    public function bloques()
    {
        return $this->belongsToMany(
            BloqueEntrenamiento::class,
            'sesion_bloque',
            'id_sesion_entrenamiento',
            'id_bloque_entrenamiento'
        )->withPivot('orden', 'repeticiones');
    }

    /**
     * Relationship: A session can be linked to one actual workout result
     */
    public function entrenamientoRealizado()
    {
        return $this->hasOne(Entrenamiento::class, 'id_sesion');
    }
}