<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocStock extends Model
{
    protected $table = 'DocStock';

    protected $fillable = [
        'tipo','tipoPessoal','tipoAcademico','$idFaseStock'
        ];

    public function faseStock(){
        return $this->belongsTo("App\FaseStock","idFaseStock");
    }
}
