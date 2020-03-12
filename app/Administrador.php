<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrador extends Model
{

    use SoftDeletes;

    protected $table = 'Administrador';

    public $timestamps = false;
    protected $primaryKey = 'idAdmin';

    protected $fillable = [
        'nome','apelido','email','dataNasc','fotografia','telefone1','telefone2',
        ];

    public function user(){
        return $this->belongsTo("App\User","idUser");
    }
}
