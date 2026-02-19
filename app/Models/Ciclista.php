<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// DO NOT MODIFY IMPORTS
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// MUST EXTEND Authenticatable
class Ciclista extends Authenticatable
{
    protected $table = 'ciclista';
    
    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'peso_base',
        'altura_base',
        'email',
        'password'
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'peso_base' => 'decimal:2',
        'altura_base' => 'integer'
    ];

    /**
     * Relationship with PlanEntrenamiento
     */
    public function planes()
    {
        return $this->hasMany(PlanEntrenamiento::class, 'id_ciclista');
    }

    /**
     * Relationship with Bicicleta
     */
    public function bicicletas()
    {
        return $this->hasMany(Bicicleta::class, 'id_ciclista');
    }

    /**
     * Relationship with HistoricoCiclista
     */
    public function historico()
    {
        return $this->hasMany(HistoricoCiclista::class, 'id_ciclista');
    }

    /**
     * Relationship with Entrenamiento
     */
    public function entrenamientos()
    {
        return $this->hasMany(Entrenamiento::class, 'id_ciclista');
    }
}