<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocNecessario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DocNecessario', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idDocNecessario');
            $table->enum('tipo',['Pessoal', 'Academico']);
            $table->enum('tipoPessoal',['Passaport','Cartão Cidadão','Carta Condução','Doc. Oficial'])->nullable();
            $table->enum('tipoAcademico',['Exame Universitário','Exame Nacional','Diploma','Certificado'])->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('idFase');
                $table->foreign('idFase')->references('idFase')->on('Fase');

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
        Schema::dropIfExists('DocNecessario');
    }
}
