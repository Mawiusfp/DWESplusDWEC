<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bicicleta extends Model
{
    protected $table = 'bicicleta';
    
    protected $fillable = [
        'nombre',
        'tipo',
        'comentario'
    ];

    /**
     * Relationship with Ciclista
     */
    public function ciclista()
    {
        return $this->belongsTo(Ciclista::class, 'id_ciclista');
    }

    /**
     * Relationship with ComponentesBicicleta
     */
    public function componentes()
    {
        return $this->hasMany(ComponentesBicicleta::class, 'id_bicicleta');
    }

    /**
     * Relationship with Entrenamiento
     */
    public function entrenamientos()
    {
        return $this->hasMany(Entrenamiento::class, 'id_bicicleta');
    }
}