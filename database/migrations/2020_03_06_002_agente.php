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
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idAgente');

            $table->unsignedBigInteger('idAgenteAssociado')->nullable();
                $table->foreign('idAgenteAssociado')->references('idAgente')->on('Agente');

            $table->string('nome',255);
            $table->string('apelido',255);
            $table->enum('genero',['F','M']);
            $table->enum('tipo',['Agente', 'Subagente']);
            $table->string('email',255)->unique();
                //$table->unique('email');
            $table->date('dataNasc');
            $table->string('fotografia',255)->nullable();
            $table->string('morada',255);
            $table->string('pais',255);
            $table->string('NIF',255)->unique();
                //$table->unique('NIF');

            $table->string('num_doc',255)->unique();
                //$table->unique('num_id');
            $table->string('img_doc',255)->nullable();
            $table->longText('info_doc')->nullable();

            $table->string('telefoneW',255);
            $table->string('telefone2',255)->nullable();

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
        Schema::dropIfExists('Agente');
    }
}
