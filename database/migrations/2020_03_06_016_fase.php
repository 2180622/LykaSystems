<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Fase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Fase', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idFase');
            $table->string('descricao',255);
            $table->dateTime('dataVencimento');
            $table->timestamps();
            $table->decimal('valorFase', 18, 2);
            $table->boolean('verificacaoPago')->default(false);
            $table->unsignedBigInteger('idProduto');
                $table->foreign('idProduto')->references('idProduto')->on('Produto');
            $table->unsignedBigInteger('idFaseStock');
                $table->foreign('idFaseStock')->references('idFaseStock')->on('FaseStock');
            $table->unsignedBigInteger('idResponsabilidade');
                $table->foreign('idResponsabilidade')->references('idResponsabilidade')->on('Responsabilidade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Fase');
    }
}
