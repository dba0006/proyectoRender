<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteModelo extends Model
{
    protected $table = 'clientes';
    
    protected $fillable = [
        'nombre',
        'email', 
        'telefono',
        'empresa',
        'direccion',
        'ciudad',
        'pais',
        'estado',
        'notas'
    ];
}
