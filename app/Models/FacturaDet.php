<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FacturaCab;

class FacturaDet extends Model
{
    use HasFactory;

    protected $table = "factura_dets";

    public $timestamps = false;

    protected $fillable = [
        'factura_cab_id',
        'producto',
        'descripcion',
        'cantidad',
        'precio_unitario',
        'subtotal',
        'iva',
        'total',
        'estado',
        'fe_creacion',
        'usr_creacion',
        'fe_ult_mod',
        'usr_ult_mod'
    ];

    public function factura() {
        return $this->belongsTo(FacturaCab::class, 'factura_cab_id');
    }
}
