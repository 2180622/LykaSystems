<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cliente', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idCliente');
            $table->string('nome',255);
            $table->string('apelido',255);
            $table->enum('genero',['F','M']);
            $table->string('email',255)->unique();
                //$table->unique('email');
            $table->string('telefone1',255);
            $table->string('telefone2',255)->nullable();
            $table->date('dataNasc');
            $table->date('dataValidPP');
            $table->string('localEmissaoPP',255);
            $table->string('paisNaturalidade',255);
            $table->string('morada',255);
            $table->string('cidade',255);
            $table->string('moradaResidencia',255);
            $table->string('passaportPaisEmi',255);
            $table->string('nomePai',255)->nullable();
            $table->string('telefonePai',255)->nullable();
            $table->string('emailPai',255)->nullable();
            $table->string('nomeMae',255)->nullable();
            $table->string('telefoneMae',255)->nullable();
            $table->string('emailMae',255)->nullable();
            $table->string('fotografia',255)->nullable()->default('default.png');
            $table->string('NIF',255)->unique();
                //$table->unique('NIF');
            $table->string('IBAN',255);
            $table->integer('nivEstudoAtual');
            $table->string('nomeInstituicaoOrigem',255);
            $table->string('cidadeInstituicaoOrigem',255);

            $table->string('num_doc',255)->unique();
                //$table->unique('num_doc');
            $table->unsignedBigInteger('idDocOficial');
                $table->foreign('idDocOficial')->references('idDocPessoal')->on('DocPessoal');
            $table->unsignedBigInteger('idDocPassaport');
                $table->foreign('idDocPassaport')->references('idDocPessoal')->on('DocPessoal');
            $table->unsignedBigInteger('idDocAcademico')->nullable();
                $table->foreign('idDocAcademico')->references('idDocAcademico')->on('DocAcademico');

            $table->longText('obsPessoais')->nullable();
            $table->longText('obsFinanceiras')->nullable();
            $table->longText('obsAcademicas')->nullable();
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
        Schema::dropIfExists('Cliente');
    }
}
