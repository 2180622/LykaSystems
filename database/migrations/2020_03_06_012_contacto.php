<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contacto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Contacto', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idContacto');
            $table->string('nome',255);
            $table->string('fotografia',255)->nullable();
            $table->integer('telefone1')->nullable();
            $table->integer('telefone2')->nullable();
            $table->string('email',255)->nullable();
            $table->integer('fax')->nullable();
            $table->longText('observacao')->nullable();
            $table->boolean('favorito')->default(false);
            $table->boolean('visibilidade')->default(false);
            $table->unsignedBigInteger('idUser')->nullable();
                $table->foreign('idUser')->references('idUser')->on('User');
            $table->unsignedBigInteger('idUniversidade')->nullable();
                $table->foreign('idUniversidade')->references('idUniversidade')->on('Universidade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Contacto');
    }
}

