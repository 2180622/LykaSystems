<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biblioteca extends Model
{
    protected $table = 'Biblioteca';
    
    public $timestamps = false;

    protected $fillable = [
        'nome','imagem'
        ];
}
