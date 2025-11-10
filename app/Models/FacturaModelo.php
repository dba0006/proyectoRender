<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaModelo extends Model
{
    protected $table = 'facturas';
    
    protected $fillable = [
        'numero_factura',
        'cliente_id',
        'fecha_emision',
        'fecha_vencimiento',
        'subtotal',
        'impuestos',
        'total',
        'estado',
        'descripcion'
    ];

    public function cliente()
    {
        return $this->belongsTo(ClienteModelo::class, 'cliente_id');
    }
}
