<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    protected $table = 'Agente';

    protected $fillable = [
        'nome','apelido','email','dataNasc','fotografia','morada','pais',
        'NIF','telefoneW','telefone2','tipo'
        ];

    public function user(){
        return $this->belongsTo("App\User","idUser");
    }
}
