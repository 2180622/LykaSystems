<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Agente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Agente', function (Blueprint $table) {
            $table->bigIncrements('idAgente');
            $table->string('nome',255);
            $table->string('apelido',255);
            $table->string('email',255);
            $table->date('dataNasc');
            $table->string('fotografia',255)->nullable();
            $table->string('morada',255);
            $table->string('pais',255);
            $table->integer('NIF');
            $table->integer('telefoneW');
            $table->integer('telefone2')->nullable();
            $table->enum('tipo',['Agente', 'Subagente']);
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
        Schema::dropIfExists('Agente');
    }
}
