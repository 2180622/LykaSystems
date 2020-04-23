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

            $table->string('telefone1',255);
            $table->string('telefone2',255)->nullable();
            $table->date('dataNasc');

            $table->string('paisNaturalidade',255);
            $table->string('morada',255);
            $table->string('cidade',255);
            $table->string('moradaResidencia',255);

            $table->string('nomePai',255)->nullable();
            $table->string('telefonePai',255)->nullable();
            $table->string('emailPai',255)->nullable();
            $table->string('nomeMae',255)->nullable();
            $table->string('telefoneMae',255)->nullable();
            $table->string('emailMae',255)->nullable();
            $table->string('fotografia',255)->nullable();
            $table->string('NIF',255)->unique()->default(null);

            $table->string('IBAN',255)->nullable();
            $table->integer('nivEstudoAtual');
            $table->string('nomeInstituicaoOrigem',255);
            $table->string('cidadeInstituicaoOrigem',255);

            $table->string('num_docOficial',255)->unique();
            $table->string('img_docOficial',255)->nullable();

            $table->longText('info_docOficial')->nullable();
            $table->string('img_Passaport',255)->nullable();
            $table->json('info_Passaport')->nullable();
            $table->string('img_docAcademico',255)->nullable();
            $table->longText('info_docAcademico')->nullable();

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
