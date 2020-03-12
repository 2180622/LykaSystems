<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Notificacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Notificacao', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idnotificacao');
            $table->boolean('urgencia')->default(false);
            $table->enum('tipo',['Atraso','Aniversario','Adicionado','Abertura']);
            $table->dateTime('dataInicio');
            $table->dateTime('dataFim');
            $table->string('assunto',255);
            $table->string('descricao',255);
            $table->timestamps();
            $table->unsignedBigInteger('idUser');
                $table->foreign('idUser')->references('idUser')->on('User');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Notificacao');
    }
}
