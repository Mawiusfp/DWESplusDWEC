<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComponentesBicicleta extends Model
{
    protected $table = 'componentes_bicicleta';
    
    protected $fillable = [
        'id_bicicleta',
        'id_tipo_componente',
        'marca',
        'modelo',
        'especificacion',
        'velocidad',
        'posicion',
        'fecha_montaje',
        'fecha_retiro',
        'km_actuales',
        'km_max_recomendado',
        'activo',
        'comentario'
    ];
    
    protected $casts = [
        'id_bicicleta' => 'integer',
        'id_tipo_componente' => 'integer',
        'fecha_montaje' => 'date',
        'fecha_retiro' => 'date',
        'km_actuales' => 'decimal:2',
        'km_max_recomendado' => 'decimal:2',
        'activo' => 'boolean'
    ];

    /**
     * Relationship with Bicicleta
     */
    public function bicicleta()
    {
        return $this->belongsTo(Bicicleta::class, 'id_bicicleta');
    }

    /**
     * Relationship with TipoComponente
     */
    public function tipoComponente()
    {
        return $this->belongsTo(TipoComponente::class, 'id_tipo_componente');
    }
}