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
        Schema::create('factura_dets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('factura_cab_id')->constrained('factura_cabs');
            $table->string('producto');
            $table->string('descripcion')->nullable();
            $table->decimal('cantidad', 10, 2);
            $table->decimal('precio_unitario', 10, 2)->unsigned();
            $table->decimal('subtotal', 10, 2)->unsigned();
            $table->decimal('iva', 10, 2)->unsigned();
            $table->decimal('total', 10, 2)->unsigned();
            $table->string('estado', 20);

            // Auditoría
            $table->timestamp('fe_creacion')->useCurrent();
            $table->string('usr_creacion', 100);
            $table->timestamp('fe_ult_mod')->nullable()->useCurrentOnUpdate();
            $table->string('usr_ult_mod', 100)->nullable();

            $table->index('factura_cab_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura_dets');
    }
};
