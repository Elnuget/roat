<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoLunasTable extends Migration
{
    public function up()
    {
        Schema::create('pedido_lunas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');
            $table->string('l_medida', 191)->nullable();
            $table->string('l_detalle', 191)->nullable();
            $table->decimal('l_precio', 8, 2)->nullable();
            $table->string('tipo_lente', 191)->nullable();
            $table->string('material', 191)->nullable();
            $table->string('filtro', 191)->nullable();
            $table->decimal('l_precio_descuento', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedido_lunas');
    }
}
