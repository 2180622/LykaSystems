<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocAcademico extends Model
{
    protected $table = 'DocAcademico';

    protected $fillable = [
        'nome','tipo','imagem','pais','nota','pontuacao','verificacao','$idFase'
        ];

    public function fase(){
        return $this->belongsTo("App\User","idFase");
    }
}
