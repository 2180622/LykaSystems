<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'Agenda';

    protected $fillable = [
        'descricao','visibilidade','dataInicio','dataFim','$idUser'
    ];

    public function user(){
        return $this->belongsTo("App\User","idUser");
    }

    public function produtoA(){
        return $this->hasMany("App\Produto","idAgente")->withTrashed();
    }

    public function produtoSubA(){
        return $this->hasMany("App\Produto","idSubAgente")->withTrashed();
    }
}
