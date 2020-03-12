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
            $table->string('email',255);
                $table->unique('email');
            $table->integer('telefone1');
            $table->integer('telefone2')->nullable();
            $table->date('dataNasc');
            $table->string('numCCid',255);
                $table->unique('numCCid');
            $table->string('numPassaport',255);
            $table->date('dataValidPP');
            $table->string('localEmissaoPP',255);
            $table->string('paisNaturalidade',255);
            $table->string('morada',255);
            $table->string('cidade',255);
            $table->string('moradaResidencia',255);
            $table->string('passaportPaisEmi',255);
            $table->string('nomePai',255)->nullable();
            $table->integer('telefonePai')->nullable();
            $table->string('emailPai',255)->nullable();
            $table->string('nomeMae',255)->nullable();
            $table->integer('telefoneMae')->nullable();
            $table->string('emailMae',255)->nullable();
            $table->string('fotografia',255)->nullable();
            $table->bigInteger('NIF');
                $table->unique('NIF');
            $table->string('IBAN',255);
            $table->integer('nivEstudoAtual');
            $table->string('nomeInstituicaoOrigem',255);
            $table->string('cidadeInstituicaoOrigem',255);
            $table->longText('obsPessoais')->nullable();
            $table->longText('obsFinanceiras')->nullable();
            $table->longText('obsAcademicas')->nullable();
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
        Schema::dropIfExists('Cliente');
    }
}
