<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoTelefonoModel extends Model
{
   protected $table = 'telefono';
   protected $primaryKey = 'idtelefono';

   protected $fillable = [
    'numero',
    'idpersona',
    'idtipotelefono'
];

public $timestamps = false;
  
}
