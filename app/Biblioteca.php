<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biblioteca extends Model
{
    protected $table = 'Biblioteca';

    protected $primaryKey = 'idBiblioteca';

    protected $fillable = [
        'descricao','ficheiro'
        ];
}
