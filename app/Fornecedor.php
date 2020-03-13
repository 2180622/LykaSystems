<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use SoftDeletes;
    protected $table = 'Fornecedor';

    protected $primaryKey = 'idFornecedor';

    protected $fillable = [
        'nome','morada','descricao'
        ];

    public function relacao(){
        return $this->hasMany("App\RelFormResp","idFornecedor","idFornecedor");
    }
}
