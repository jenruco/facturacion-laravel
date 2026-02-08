<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_cabs', function (Blueprint $table) {
            $table->id();
            $table->string('numero_factura')->unique();
            $table->date('fecha_emision');
            $table->string('cliente');
            $table->decimal('subtotal', 10, 2)->unsigned();
            $table->decimal('iva', 10, 2)->unsigned();
            $table->decimal('descuento', 10, 2)->unsigned()->default(0);
            $table->decimal('total', 10, 2)->unsigned();
            $table->string('metodo_pago');
            $table->string('observacion')->nullable();
            $table->string('estado', 20);

            // Auditoría
            $table->timestamp('fe_creacion')->useCurrent();
            $table->string('usr_creacion', 100);
            $table->timestamp('fe_ult_mod')->nullable()->useCurrentOnUpdate();
            $table->string('usr_ult_mod', 100)->nullable();

            $table->index('fecha_emision');
            $table->index('estado');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura_cabs');
    }
};
