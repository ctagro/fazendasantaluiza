<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModoAtuacaoIdTableDefensivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('defensivos', function (Blueprint $table) {
            $table->unsignedBigInteger('modo_atuacao_id')->nullable() // Nome da coluna
            ->after('modeOperation_id'); // Ordenado após a coluna "modeOperation_id"
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
            $table->dropColumn('modo_atuacao_id');
        });
    }
}
