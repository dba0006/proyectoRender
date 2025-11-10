<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidenciaModelo extends Model
{
    protected $table = 'incidencias';
    
    protected $fillable = [
        'titulo',
        'descripcion',
        'cliente_id',
        'user_id',
        'prioridad',
        'estado',
        'fecha_reporte',
        'fecha_resolucion',
        'solucion'
    ];

    public function cliente()
    {
        return $this->belongsTo(ClienteModelo::class, 'cliente_id');
    }

    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
