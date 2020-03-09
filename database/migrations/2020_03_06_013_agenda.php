<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Agenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Agenda', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idAgenda');
            $table->text('descricao');
            $table->boolean('visibilidade')->default(false);
            $table->dateTime('dataInicio');
            $table->dateTime('dataFim');
            $table->dateTime('dataCriacao')->useCurrent();
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
        Schema::dropIfExists('Agenda');
    }
}
