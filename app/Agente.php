<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Agente extends Model
{

    use SoftDeletes;

    protected $table = 'Agente';

    protected $primaryKey = 'idAgente';

    protected $fillable = [
        'subagent_agentid','nome','apelido','genero','email','dataNasc','fotografia','morada','pais',
        'NIF','telefoneW','telefone2','tipo'
        ];

    public function user(){
        return $this->belongsTo("App\User","idUser","idUser");
    }

    public function produtoA(){
        return $this->hasMany("App\Produto","idAgente","idAgente")->withTrashed();
    }

    public function produtoSubA(){
        return $this->hasMany("App\Produto","idSubAgente","idAgente")->withTrashed();
    }
}
