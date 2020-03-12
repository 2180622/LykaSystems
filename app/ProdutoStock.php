<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutoStock extends Model
{
    use SoftDeletes;
    protected $table = 'ProdutoStock';
    
    public $timestamps = false;

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
