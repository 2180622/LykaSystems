<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'Administrador';
    
    public $timestamps = false;

    protected $fillable = [
        'nome','apelido','email','dataNasc','fotografia','telefone1','telefone2'
        ];

    public function user(){
        return $this->belongsTo("App\User","idUser");
    }
}
