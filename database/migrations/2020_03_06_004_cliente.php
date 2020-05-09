<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cliente extends Migration
{
    public function up()
    {
        Schema::create('Cliente', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->bigIncrements('idCliente');
            $table->unsignedBigInteger('idAgente')->nullable();

            $table->string('nome',255);
            $table->string('apelido',255);
            $table->enum('genero',['F','M']);
            $table->string('email',255)->unique();
            $table->string('telefone1',255);
            $table->string('telefone2',255)->nullable();
            $table->date('dataNasc')->nullable();
            $table->string('paisNaturalidade',255)->nullable();
            $table->string('morada',255)->nullable();
            $table->string('cidade',255)->nullable();
            $table->string('moradaResidencia',255)->nullable();
            $table->string('nomePai',255)->nullable();
            $table->string('telefonePai',255)->nullable();
            $table->string('emailPai',255)->nullable();
            $table->string('nomeMae',255)->nullable();
            $table->string('telefoneMae',255)->nullable();
            $table->string('emailMae',255)->nullable();
            $table->string('fotografia',255)->nullable();
            $table->string('NIF',255)->unique()->default(null)->nullable();
            $table->string('IBAN',255)->nullable();
            $table->integer('nivEstudoAtual')->default("0")->nullable();
            $table->string('nomeInstituicaoOrigem',255)->nullable();
            $table->string('cidadeInstituicaoOrigem',255)->nullable();


            $table->string('num_docOficial',255)->unique();
/*             $table->string('img_docOficial',255)->nullable(); */
            $table->longText('validade_docOficial')->nullable(); /* data de validade */
/*             $table->string('img_Passaporte',255)->nullable(); */
            $table->longText('num_passaporte')->nullable();
/*             $table->string('img_docAcademico',255)->nullable(); */
/*             $table->longText('info_docAcademico')->nullable(); */


            $table->longText('obsPessoais')->nullable();
            $table->longText('obsFinanceiras')->nullable();
            $table->longText('obsAcademicas')->nullable();

            $table->string('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Cliente');
    }
}
