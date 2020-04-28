<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaseStock extends Model
{
    protected $table = 'FaseStock';

    protected $primaryKey = 'idFaseStock';

    protected $fillable = [
        'descricao','$idProdutoStock'
        ];

    public function produtoStock(){
        return $this->belongsTo("App\ProdutoStock","idProdutoStock","idProdutoStock")->withTrashed();
    }

    public function docStock(){
        return $this->hasMany("App\DocStock","idFaseStock","idFaseStock")->withTrashed();
    }
    public function fase(){
        return $this->hasMany("App\Fase","idFaseStock","idFaseStock")->withTrashed();
    }
}
