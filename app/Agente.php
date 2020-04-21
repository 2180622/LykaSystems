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

        'idAgenteAssociado','nome','apelido','genero','tipo','email','dataNasc','fotografia','morada','pais','NIF','num_doc','img_doc','info_doc','telefone1','telefone2'
        ];

    public function user(){
        return $this->belongsTo("App\User","idUser","idUser")->withTrashed();
    }

    public function produtoA(){
        return $this->hasMany("App\Produto","idAgente","idAgente")->withTrashed();
    }

    public function produtoSubA(){
        return $this->hasMany("App\Produto","idSubAgente","idAgente")->withTrashed();
    }

    public function subAgente(){
        return $this->hasMany("App\Agente","idAgente","idAgenteAssociado")->withTrashed();
    }

    public function agente(){
        return $this->belongsTo("App\Agente","idAgenteAssociado","idAgente")->withTrashed();
    }
}
