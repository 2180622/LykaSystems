<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocTransacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DocTransacao', function (Blueprint $table) {
            $table->bigIncrements('idDocTransacao');
            $table->string('descricao',255);
            $table->decimal('valorRecebido', 18, 2)->default(0);
            $table->date('dataOperacao');
            $table->date('dataRecebido')->nullable();
            $table->boolean('verificacao')->default(false);
            $table->string('imagem',255);
            $table->unsignedBigInteger('idConta');
                $table->foreign('idConta')->references('idConta')->on('Conta');
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
        Schema::dropIfExists('DocTransacao');
    }
}
