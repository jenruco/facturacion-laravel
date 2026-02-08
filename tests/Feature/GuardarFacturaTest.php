<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GuardarFacturaTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function puede_guardar_una_factura_con_detalles()
    {
        $payload = [
            'numero_factura' => 'F-001',
            'fecha_emision' => '2026-02-08',
            'cliente' => 'Cliente Test',
            'metodo_pago' => 'EFECTIVO',
            'observacion' => 'Factura de prueba',
            'productos' => [
                [
                    'producto' => 'Producto A',
                    'cantidad' => 2,
                    'precio' => 10
                ],
                [
                    'producto' => 'Producto B',
                    'cantidad' => 1,
                    'precio' => 20
                ]
            ]
        ];

        $response = $this->withoutMiddleware()->post('/guardar', $payload);

        $response->assertRedirect(route('factura.index'));

        $this->assertDatabaseHas('factura_cabs', [
            'numero_factura' => 'F-001',
            'cliente' => 'Cliente Test'
        ]);

        $this->assertDatabaseHas('factura_dets', [
            'producto' => 'Producto A',
            'cantidad' => 2
        ]);

        $this->assertDatabaseHas('factura_dets', [
            'producto' => 'Producto B',
            'cantidad' => 1
        ]);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /*public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }*/
}
