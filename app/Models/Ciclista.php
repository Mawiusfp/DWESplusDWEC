<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
<<<<<<< HEAD
use Illuminate\Notifications\Notifiable;
=======
>>>>>>> a66eeea384328103b389f08c40d38a4d345f8613

class Ciclista extends Authenticatable
{
    use Notifiable;

    protected $table = 'ciclistas';

    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'peso_base',
        'altura_base',
        'email',
<<<<<<< HEAD
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
=======
        'password',
    ];
>>>>>>> a66eeea384328103b389f08c40d38a4d345f8613
}
