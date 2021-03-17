<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoTelefonoModel extends Model
{
   protected $table = 'tipotelefono';
   protected $primaryKey = 'idtipotelefono';

   protected $fillable = [
    'idtipotelefono',
    'descripcion'
];

public $timestamps = false;
  
}
