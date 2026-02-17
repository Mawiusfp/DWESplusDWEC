<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EXAMPLE_DONTUSEME extends Model
{

    // Must match the sql table-name
    protected $table = 'name_of_your_table';
    
    // These are the columns
    protected $fillable = [
        'column1',
        'column2',
        'column3',
        'column4',
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
        'im_a_float' => 'float',
        'im_a_number' => 'integer',
        'im_a_datetime' => 'datetime',
    ];

    /**
     * Relationship with SesionEntrenamiento via the pivot table 'sesion_bloque'
     */
    public function sesiones()
    {
        return $this->belongsToMany(
            SesionEntrenamiento::class, 
            'sesion_bloque',            // Name of the pivot table
            'id_bloque_entrenamiento',  // Foreign key for THIS model in pivot
            'id_sesion_entrenamiento'   // Foreign key for the TARGET model in pivot
        )->withPivot('orden', 'repeticiones'); // Allow access to extra pivot columns
    }
}