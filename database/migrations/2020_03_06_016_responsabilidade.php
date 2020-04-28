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
            $table->decimal('valorCliente', 18, 2);
            $table->decimal('valorAgente', 18, 2);
            $table->decimal('valorSubAgente', 18, 2)->nullable();
            $table->decimal('valorUniversidade1', 18, 2);
            $table->decimal('valorUniversidade2', 18, 2)->nullable();
            $table->boolean('verificacaoPagoCliente')->default(false);
            $table->boolean('verificacaoPagoAgente')->default(false);
            $table->boolean('verificacaoPagoSubAgente')->default(false);
            $table->boolean('verificacaoPagoUni1')->default(false);
            $table->boolean('verificacaoPagoUni2')->default(false);
            $table->dateTime('dataVencimentoPagamentoCliente');
            $table->dateTime('dataVencimentoPagamentoAgente');
            $table->dateTime('dataVencimentoPagamentoSubAgente')->nullable();
            $table->dateTime('dataVencimentoPagamentoUni1');
            $table->dateTime('dataVencimentoPagamentoUni2')->nullable();
            $table->enum('estado', ['Pendente', 'Pago', 'Dívida'])->default('Pendente');
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
        Schema::dropIfExists('Responsabilidade');
    }
}
