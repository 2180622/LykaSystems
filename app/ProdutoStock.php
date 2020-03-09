<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoStock extends Model
{
    protected $table = 'ProdutoStock';

    protected $fillable = [
        'descricao','tipo','anoAcademico'
        ];

    public function produto(){
        return $this->hasMany("App\Produto","idProdutoStock");
    }

    public function faseStock(){
        return $this->hasMany("App\faseStock","idProdutoStock");
    }
}
