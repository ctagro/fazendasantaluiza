<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceCeasaBhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_ceasa_bhs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->text('product',50);
            $table->text('embalagem',50);
            $table->double('price_min',6,2);
            $table->double('price_com',6,2);
            $table->double('price_max',6,2);
            $table->text('situation',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_ceasa_bhs');
    }
}
