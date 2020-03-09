<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'Produto';

    protected $fillable = [
        'descricao','tipo','anoAcademico','valorTotal','valorTotalAgente',
        'valorTotalSubAgente','$idAgente','$idSubAgente','$idCliente',
        '$idUniversidade1','$idUniversidade2','$idProdutoStock'
        ];

    public function cliente(){
        return $this->belongsTo("App\Cliente","idCliente");
    }

    public function agente(){
        return $this->belongsTo("App\Agente","idAgente");
    }

    public function subAgente(){
        return $this->belongsTo("App\Agente","idSubAgente");
    }

    public function universidade1(){
        return $this->belongsTo("App\Universidade","idUniversidade1");
    }

    public function universidade2(){
        return $this->belongsTo("App\Universidade","idUniversidade2");
    }

    public function produtoStock(){
        return $this->belongsTo("App\ProdutoStock","idProdutoStock");
    }

    public function fase(){
        return $this->hasMany("App\Fase","idProduto");
    }
}
