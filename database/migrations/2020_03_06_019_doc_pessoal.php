<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocPessoal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DocPessoal', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idDocPessoal');
            $table->string('nome',255);
            $table->string('apelido',255);
            $table->enum('tipo',['Passaport','Cartão Cidadão','Carta Condução','Doc. Oficial']);
            $table->string('imagem',255);
            $table->integer('numDoc');
            $table->date('dataValidade');
            $table->string('pais',255);
            $table->string('morada',255);
            $table->boolean('verificacao')->default(false);
            $table->timestamps();
            $table->unsignedBigInteger('idFase');
                $table->foreign('idFase')->references('idFase')->on('Fase');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DocPessoal');
    }
}
