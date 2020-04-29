<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Responsabilidade extends Migration
{
    public function up()
    {
        Schema::create('Responsabilidade', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idResponsabilidade');

            $table->decimal('valorCliente', 18, 2)->nullable();
            $table->unsignedBigInteger('idCliente');
                $table->foreign('idCliente')->references('idCliente')->on('Cliente');
            $table->boolean('verificacaoPagoCliente')->default(false);
            $table->dateTime('dataVencimentoCliente')->nullable();

            $table->decimal('valorAgente', 18, 2)->nullable();
            $table->unsignedBigInteger('idAgente');
                $table->foreign('idAgente')->references('idAgente')->on('Agente');
            $table->boolean('verificacaoPagoAgente')->default(false);
            $table->dateTime('dataVencimentoAgente')->nullable();

            $table->decimal('valorSubAgente', 18, 2)->nullable();
            $table->unsignedBigInteger('idSubAgente')->nullable();
                $table->foreign('idSubAgente')->references('idAgente')->on('Agente');
            $table->boolean('verificacaoPagoSubAgente')->default(false);
            $table->dateTime('dataVencimentoSubAgente')->nullable();

            $table->decimal('valorUniversidade1', 18, 2)->nullable();
            $table->unsignedBigInteger('idUniversidade1');
                $table->foreign('idUniversidade1')->references('idUniversidade')->on('Universidade');
            $table->boolean('verificacaoPagoUni1')->default(false);
            $table->dateTime('dataVencimentoUni1')->nullable();

            $table->decimal('valorUniversidade2', 18, 2)->nullable();
            $table->unsignedBigInteger('idUniversidade2')->nullable();
                $table->foreign('idUniversidade2')->references('idUniversidade')->on('Universidade');
            $table->boolean('verificacaoPagoUni2')->default(false);
            $table->dateTime('dataVencimentoUni2')->nullable();

            $table->enum('estado', ['Pendente', 'Pago', 'Dívida'])->default('Pendente');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Responsabilidade');
    }
}
