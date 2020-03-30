<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PagoResponsabilidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PagoResponsabilidade', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idPagoResp');
            $table->date('data');
            $table->string('nomeAutor',255);
            $table->string('imagem',255);
            $table->timestamps();
            $table->unsignedBigInteger('idFase');
                $table->foreign('idFase')->references('idFase')->on('Fase');
            $table->unsignedBigInteger('idConta');
                $table->foreign('idConta')->references('idConta')->on('Conta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PagoResponsabilidade');
    }
}