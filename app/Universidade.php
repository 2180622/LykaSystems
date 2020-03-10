<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Universidade extends Model
{
    protected $table = 'Universidade';
    
    public $timestamps = false;

    protected $fillable = [
        'nome','morada','telefone','email','NIF','IBAN','obsContactos','obsCursos','obsCandidaturas'
        ];

    public function produto(){
        return $this->hasMany("App\Produto","idUniversidade1");
    }

    public function produto2(){
        return $this->hasMany("App\Produto","idUniversidade2");
    }
}
