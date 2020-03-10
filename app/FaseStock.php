<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaseStock extends Model
{
    protected $table = 'FaseStock';
    
    public $timestamps = false;

    protected $fillable = [
        'descricao','$idProdutoStock'
        ];

    public function produtoStock(){
        return $this->belongsTo("App\ProdutoStock","idProdutoStock")->withTrashed();
    }
}
