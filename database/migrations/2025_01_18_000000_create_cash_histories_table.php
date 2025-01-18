<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('cash_histories', function (Blueprint $table) {
            $table->id();
            $table->decimal('monto', 10, 2);
            $table->string('estado');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cash_histories');
    }
}
