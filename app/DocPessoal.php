<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocPessoal extends Model
{
    protected $table = 'DocPessoal';

    protected $primaryKey = 'idDocPessoal';

    protected $fillable = [
        'tipo','imagem','info','dataValidade','verificacao','$idFase'
        ];

    public function fase(){
        return $this->belongsTo("App\Fase","idFase","idFase")->withTrashed();
    }
}
