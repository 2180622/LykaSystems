<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Universidade extends Model
{
    use SoftDeletes;
    protected $table = 'Universidade';

    public $timestamps = false;

    protected $fillable = [
        'nome','morada','telefone','email','NIF','IBAN','obsContactos','obsCursos','obsCandidaturas',
        ];

    public function produto(){
        return $this->hasMany("App\Produto","idUniversidade1");
    }

    public function produto2(){
        return $this->hasMany("App\Produto","idUniversidade2");
    }

    use SoftDeletes;
}
