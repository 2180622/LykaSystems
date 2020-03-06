<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('User', function (Blueprint $table) {
            $table->increments('idUser');
            $table->string('username',255);
            $table->enum('tipo',['admin', 'agente', 'cliente']);
            $table->string('password_hash',255);
            $table->string('password_reset_token',255)->nullable();
            $table->string('verification_token',255)->nullable();
            $table->string('auth_key',50);
            $table->integer('status');
            $table->timestamps();
            $table->unsignedBigInteger('idAdmin')->nullable();
            $table->unsignedBigInteger('idAgente')->nullable();
            $table->unsignedBigInteger('idCliente')->nullable();

            /*$table->foreign('idAdmin')->references('idAdmin')->on('Administrador');
            $table->foreign('idAgente')->references('idAgente')->on('Agente');
            $table->foreign('idCliente')->references('idCliente')->on('Cliente');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('User');
    }
}
