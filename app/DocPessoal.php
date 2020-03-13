<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocPessoal extends Model
{
    protected $table = 'DocPessoal';

    protected $primaryKey = 'idDocPessoal';

    protected $fillable = [
        'nome','apelido','tipo','imagem','numDoc','dataValidade','pais',
        'morada','verificacao','$idFase'
        ];

    public function fase(){
        return $this->belongsTo("App\Fase","idFase","idFase");
    }
}
