<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    protected $table = 'Fase';

    protected $fillable = [
        'descricao','dataVencimento','valorFase','verificacaoPago','valorComissaoAgente',
        'valorComSubAgente','$idProduto','$idFaseStock'
        ];

    public function produto(){
        return $this->belongsTo("App\Produto","idProduto");
    }

    public function responsabilidade(){
        return $this->hasMany("App\Responsabilidade","idFase","idFase");
    }

    public function docTransacao(){
        return $this->hasMany("App\DocTransacao","idFase","idFase");
    }

    public function docAcademico(){
        return $this->hasMany("App\DocAcademico","idFase","idFase");
    }

    public function docPessoal(){
        return $this->hasMany("App\DocPessoal","idFase","idFase");
    }

    public function pagoResponsabilidade(){
        return $this->hasMany("App\PagoResponsabilidade","idFase","idFase");
    }

    public function faseStock(){
        return $this->belongsTo("App\FaseStock","idFaseStock");
    }
}
