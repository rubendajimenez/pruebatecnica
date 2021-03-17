<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';
    protected $primaryKey = 'idpersona';//comentario

    protected $fillable = [
        'nombre',
        'apellidopaterno',
        'apellidomaterno',
        'ci',
        'direccion'
    ];

    public $timestamps = false;
}
