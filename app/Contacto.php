<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'Contacto';
    
    public $timestamps = false;

    protected $fillable = [
        'nome','fotografia','telefone1','telefone2','email','fax','observacao'
        ];
}
