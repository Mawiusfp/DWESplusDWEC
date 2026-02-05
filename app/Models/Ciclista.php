<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Ciclista extends Model
{
    protected $fillable = [
    'nombre',
    'apellidos',
    'fecha_nacimiento',
    'peso_base',
    'altura_base',
    'email',
    'password'
    ];

}
?>