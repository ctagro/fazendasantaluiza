<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivePrinciplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_principles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name',200);
            $table->unsignedBigInteger('agronomicClass_id')->nullable(); // Classe agronômica
            $table->longtext('note');
            $table->enum('in_use',['S','N'])->default("S");
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
        Schema::dropIfExists('active_principles');
    }
}
