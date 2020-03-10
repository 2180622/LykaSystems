<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Administrador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Administrador', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idAdmin');
            $table->string('nome',255);
            $table->string('apelido',255);
            $table->string('email',255);
            $table->unique('email');
            $table->date('dataNasc');
            $table->string('fotografia',255)->nullable();
            $table->integer('telefone1');
            $table->integer('telefone2')->nullable();
            $table->dateTime('dataRegis')->useCurrent();

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
        Schema::dropIfExists('Administrador');
    }
}
