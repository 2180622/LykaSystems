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
            $table->bigIncrements('idFase');
            $table->string('descricao',255);
            $table->dateTime('dataVencimento');
            $table->dateTime('update_at')->nullable();
            $table->decimal('valorFase', 18, 2);
            $table->boolean('verificacaoPago')->default(false);
            $table->decimal('valorComissaoAgente', 18, 2);
            $table->decimal('valorComSubAgente', 18, 2)->nullable();
            $table->unsignedBigInteger('idProduto');
                $table->foreign('idProduto')->references('idProduto')->on('Produto');
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
