<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGrupoQuimicoIdTableDefensivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('defensivos', function (Blueprint $table) {
            $table->unsignedBigInteger('grupo_quimico_id')->nullable() // Nome da coluna
            ->after('chemicalGroup_id'); // Ordenado após a coluna "chemicalGroup_id"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('defensivos', function (Blueprint $table) {
            $table->dropColumn('grupo_quimico_id');
        });
    }
}
