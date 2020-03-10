<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocTransacao extends Model
{
    protected $table = 'DocTransacao';
    
    public $timestamps = false;

    protected $fillable = [
        'descricao','valorRecebido','dataOperacao','dataRecebido','verificacao',
        'imagem','$idConta','$idFase'
        ];

    public function fase(){
        return $this->belongsTo("App\Fase","idFase");
    }

    public function conta(){
        return $this->belongsTo("App\Conta","idConta")->withTrashed();
    }
}
