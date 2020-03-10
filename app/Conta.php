<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    protected $table = 'Conta';
    
    public $timestamps = false;

    protected $fillable = [
        'descricao','local','numConta','IBAN','instituicao','telefone','obsConta'
    ];

    public function responsabilidade(){
        return $this->hasMany("App\Responsabilidade","idConta");
    }

    public function docTransacao(){
        return $this->hasMany("App\DocTransacao","idConta");
    }
}
