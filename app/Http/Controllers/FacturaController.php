<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\FacturaCab;
use App\Models\FacturaDet;
use App\Services\FacturaService;

class FacturaController extends Controller
{
    //

    public function guardar(Request $request, FacturaService $facturaService) {
        

        $factura = $facturaService->guardaFactura($request->all());

        return redirect('/')->with('succes', 'Factura creada con éxito');
    }
}
