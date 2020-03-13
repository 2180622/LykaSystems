<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conta extends Model
{
    use SoftDeletes;
    protected $table = 'Conta';

    protected $primaryKey = 'idConta';

    protected $fillable = [
        'descricao','local','numConta','IBAN','instituicao','telefone','obsConta'
    ];

    public function responsabilidade(){
        return $this->hasMany("App\Responsabilidade","idConta","idConta");
    }

    public function docTransacao(){
        return $this->hasMany("App\DocTransacao","idConta","idConta");
    }
}
