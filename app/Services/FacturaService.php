<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\FacturaCab;
use Illuminate\Support\Facades\Log;

class FacturaService {

    public function guardaFactura(array $data) {
        Log::info($data);
        return DB::transaction(function () use ($data) {

            $factura = FacturaCab::create([
                'numero_factura' => $data['numero_factura'],
                'fecha_emision' => $data['fecha_emision'],
                'cliente' => $data['cliente'],
                'metodo_pago' => $data['metodo_pago'],
                'usr_creacion' => 'admin',
                'subtotal' => 0,
                'iva' => 0,
                'descuento' => 0,
                'total' => 0,
                'observacion' => $data['observacion'],
                'estado' => 'Activo'
            ]);

            /*$factura = new FacturaCab();

            $factura->numero_factura = $data['numero_factura'];
            $factura->fecha_emision = $data['fecha_emision'];
            $factura->cliente = $data['cliente'];
            $factura->metodo_pago = $data['metodo_pago'];
            $factura->usr_creacion = 'admin';
            $factura->subtotal = 0;
            $factura->iva = 0;
            $factura->descuento = 0;
            $factura->total = 0;
            $factura->observacion = $data['observacion'];
            $factura->estado = 'Activo';

            $factura->save();*/

            foreach($data['productos'] as $producto) {
            
                $factura->detalles()->create([
                    'producto' => $producto['producto'],
                    'descripcion' => $producto['producto'],
                    'cantidad' => $producto['cantidad'],
                    'precio_unitario' => $producto['precio'],
                    'subtotal' => 0,
                    'iva' => 15,
                    'total' => 0,
                    'estado' => 'Activo',
                    'usr_creacion' => 'admin'
                    
                ]);
            }

            return $factura;
        });
    }
}