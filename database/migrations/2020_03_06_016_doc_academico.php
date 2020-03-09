<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocAcademico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DocAcademico', function (Blueprint $table) {
            $table->bigIncrements('idDocAcademico');
            $table->string('nome',255);
            $table->enum('tipo',['Exame Universitário','Exame Nacional','Diploma','Certificado']);
            $table->string('imagem',255);
            $table->string('pais',255);
            $table->decimal('nota', 18, 2);
            $table->string('pontuacao',255);
            $table->dateTime('dataPublicacao')->useCurrent();
            $table->boolean('verificacao')->default(false);
            $table->unsignedBigInteger('idFase');
                $table->foreign('idFase')->references('idFase')->on('Fase');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DocAcademico');
    }
}
