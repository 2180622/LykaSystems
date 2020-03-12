<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Universidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Universidade', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idUniversidade');
            $table->string('nome',255);
            $table->string('morada',255);
            $table->integer('telefone');
            $table->string('email',255);
            $table->bigInteger('NIF');
                $table->unique('NIF');
            $table->string('IBAN',255);
            $table->longText('obsContactos')->nullable();
            $table->longText('obsCursos')->nullable();
            $table->longText('obsCandidaturas')->nullable();
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
        Schema::dropIfExists('Universidade');
    }
}
