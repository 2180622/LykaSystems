<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'Contacto';

    protected $fillable = [
        'nome','fotografia','telefone1','telefone2','email','fax','observacao'
        ];
}
