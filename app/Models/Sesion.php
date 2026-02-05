<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Sesion extends Model
{
 protected $fillable = [
 'id',
 'id_plan',
 'fecha',
 'nombre',
 'descripcion',
 'completada'
 ];
 protected $dates = [
 'published_at',
 ];
}
?>