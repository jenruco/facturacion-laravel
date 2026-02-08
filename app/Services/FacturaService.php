<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\FacturaCab;
use Illuminate\Support\Facades\Log;

class FacturaService {

    public function guardaFactura(array $data): FacturaCab {
        Log::info($data);
        return DB::transaction(function () use ($data) {

            $subtotalCab = 0;

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

            foreach($data['productos'] as $producto) {

                $subtotalDet = 0;
                
                if(!empty($producto['cantidad']) && !empty($producto['precio'])) {
                    $subtotalDet = $producto['cantidad'] * $producto['precio'];

                    $subtotalCab += $subtotalDet;
                }

                $ivaDet = 0.15 * $subtotalDet;
                $totalDet = $subtotalDet + $ivaDet;
            
                $factura->detalles()->create([
                    'producto' => $producto['producto'],
                    'descripcion' => $producto['producto'],
                    'cantidad' => $producto['cantidad'],
                    'precio_unitario' => $producto['precio'],
                    'subtotal' => $subtotalDet,
                    'iva' => $ivaDet,
                    'total' => $totalDet,
                    'estado' => 'Activo',
                    'usr_creacion' => 'admin'
                    
                ]);
            }

            $ivaCab = $subtotalCab * 0.15;
            $totalCab = $subtotalCab + $ivaCab;

            $factura->update([
                'subtotal' => $subtotalCab,
                'iva' => $ivaCab,
                'total' => $totalCab,
                'usr_ult_mod' => 'admin'
            ]);

            return $factura;
        });
    }
}