<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesticidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesticides', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('name',50); // Nome comercial
            $table->unsignedBigInteger('manufacturer_id')->nullable(); // Fabricante
            $table->unsignedBigInteger('agronomicClass_id')->nullable(); // Classe agronômica
            $table->unsignedBigInteger('formulationType_id')->nullable(); // Tipo de Formulação
            $table->text('dosage',50)->nullable(); // Dosagem
            $table->text('unity',10)->nullable();  // Unidade da dosagem
            $table->unsignedBigInteger('applicationMode_id')->nullable(); //  Modo de Aplicação
            $table->unsignedBigInteger('toxicologicalClass_id')->nullable(); //  Classe Toxicológica
            $table->unsignedBigInteger('chemicalGroup_id')->nullable(); //  Grupo Químico
            $table->unsignedBigInteger('actionSite_id')->nullable(); //  Sítio de Ação
            $table->unsignedBigInteger('modeOperation_id')->nullable(); //  Modo de Atuação
            $table->text('actuationMechanism',200)->nullable(); // Mecanismo de Atuação
            $table->integer('applicationRange')->nullable(); // Intervalo de Aplicações em dias
            $table->integer('numberApplications')->nullable(); // Número de Aplicações 
            $table->longtext('note');
            $table->string('image', 100)->nullable(); // 1 foto do produto
            $table->enum('in_use',['S','N'])->default("S");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesticides');
    }
}
