<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'Produto';

    protected $fillable = [
        'descricao','tipo','anoAcademico','valorTotal','valorTotalAgente',
        'valorTotalSubAgente','$idAgente','$idSubAgente','$idCliente',
        '$idUniversidade1','$idUniversidade2'
        ];

    public function cliente(){
        return $this->belongsTo("App\Cliente","idCliente");
    }

    public function agente(){
        return $this->belongsTo("App\Agente","idAgente")->withTrashed();
    }

    public function subAgente(){
        return $this->belongsTo("App\Agente","idSubAgente")->withTrashed();
    }

    public function universidade1(){
        return $this->belongsTo("App\Universidade","idUniversidade1")->withTrashed();
    }

    public function universidade2(){
        return $this->belongsTo("App\Universidade","idUniversidade2")->withTrashed();
    }

    public function fase(){
        return $this->hasMany("App\Fase","idProduto");
    }
}
