<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'Administrador';

    protected $fillable = [
        'nome', 'apelido', 'email', 'dataNasc', 'fotografia', 'telefone1', 'telefone2', 'dataRegis',
    ];
}
