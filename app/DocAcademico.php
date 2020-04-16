<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocAcademico extends Model
{
    protected $table = 'DocAcademico';

    protected $primaryKey = 'idDocAcademico';

    protected $fillable = [
        'idCliente','nome','tipo','imagem','info','verificacao','$idFase'
        ];

    public function fase(){
        return $this->belongsTo("App\User","idFase","idFase")->withTrashed();
    }
}
