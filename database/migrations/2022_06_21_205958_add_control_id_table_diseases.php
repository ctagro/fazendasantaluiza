<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddControlIdTableDiseases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diseases', function (Blueprint $table) {
            $table->unsignedBigInteger('control_id')->nullable() // Tipo de controle
            ->after('symptoms'); // Ordenado após a coluna "user_id"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diseases', function (Blueprint $table) {
            $table->dropColumn('control_id');
        });
    }
}
