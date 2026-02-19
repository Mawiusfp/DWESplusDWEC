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
        'completada'
    ];
    
    protected $casts = [
        'id_plan' => 'integer',
        'fecha' => 'date',
        'completada' => 'boolean'
    ];

    /**
     * Relationship with PlanEntrenamiento
     */
    public function plan()
    {
        return $this->belongsTo(PlanEntrenamiento::class, 'id_plan');
    }

    /**
     * Relationship with SesionBloque
     */
    public function sesionBloques()
    {
        return $this->hasMany(SesionBloque::class, 'id_sesion_entrenamiento');
    }

    /**
     * Relationship with Entrenamiento
     */
    public function entrenamiento()
    {
        return $this->hasOne(Entrenamiento::class, 'id_sesion');
    }
}