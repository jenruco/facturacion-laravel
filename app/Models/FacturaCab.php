<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FacturaDet;

class FacturaCab extends Model
{
    use HasFactory;

    protected $table = "factura_cabs";

    public $timestamps = false;

    protected $fillable = [
        'numero_factura',
        'fecha_emision',
        'cliente',
        'subtotal',
        'iva',
        'descuento',
        'total',
        'metodo_pago',
        'observacion',
        'estado',
        'fe_creacion',
        'usr_creacion',
        'fe_ult_mod',
        'usr_ult_mod'
    ];

    public function detalles() {
        return $this->hasMany(FacturaDet::class, 'factura_cab_id');
    }
}
