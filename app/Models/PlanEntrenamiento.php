<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanEntrenamiento extends Model
{
    protected $table = 'plan_entrenamiento';
    
    protected $fillable = [
        'id_ciclista',
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'objetivo',
        'activo'
    ];
    
    protected $casts = [
        'id_ciclista' => 'integer',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'activo' => 'boolean'
    ];

    /**
     * Relationship with Ciclista
     */
    public function ciclista()
    {
        return $this->belongsTo(Ciclista::class, 'id_ciclista');
    }

    /**
     * Relationship with SesionEntrenamiento
     */
    public function sesiones()
    {
        return $this->hasMany(SesionEntrenamiento::class, 'id_plan');
    }
}