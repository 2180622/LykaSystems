<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'Fornecedor';
    
    public $timestamps = false;

    protected $fillable = [
        'nome','morada','descricao'
        ];

    public function relacao(){
        return $this->hasMany("App\RelFormResp","idFornecedor");
    }
}
