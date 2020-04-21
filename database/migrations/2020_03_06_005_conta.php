<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Conta extends Migration
{
    public function up()
    {
        Schema::create('Conta', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idConta');
            $table->string('descricao',255);
            $table->string('instituicao',255);
            $table->string('titular',255);
            $table->string('morada',255);
            $table->bigInteger('numConta')->unique();
            $table->string('IBAN',255)->nullable()->unique();
            $table->string('SWIFT',255)->nullable()->unique();
            $table->string('contacto')->nullable();
            $table->longText('obsConta')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Conta');
    }
}
