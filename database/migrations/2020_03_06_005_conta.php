<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Conta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Conta', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idConta');
            $table->string('descricao',255);
            $table->string('local',255);
            $table->bigInteger('numConta')->unique();
                //$table->unique('numConta');
            $table->string('IBAN',255);
            $table->string('instituicao',255);
            $table->integer('telefone');
            $table->longText('obsConta')->nullable();
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
        Schema::dropIfExists('Conta');
    }
}
