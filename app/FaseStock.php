<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaseStock extends Model
{
    use SoftDeletes;
    protected $table = 'FaseStock';
    
    public $timestamps = false;

    protected $fillable = [
        'descricao','$idProdutoStock'
        ];

    public function produtoStock(){
        return $this->belongsTo("App\ProdutoStock","idProdutoStock")->withTrashed();
    }
}
