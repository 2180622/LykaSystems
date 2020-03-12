<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Responsabilidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Responsabilidade', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idResponsabilidade');
            $table->string('descricao',255);
            $table->decimal('valorCliente', 18, 2);
            $table->decimal('valorAgente', 18, 2);
            $table->decimal('valorSubAgente', 18, 2)->nullable();
            $table->decimal('valorUniversidade1', 18, 2);
            $table->decimal('valorUniversidade2', 18, 2)->nullable();
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
        Schema::dropIfExists('Responsabilidade');
    }
}
