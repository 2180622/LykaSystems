<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocStock extends Model
{
    protected $table = 'DocStock';
    
    public $timestamps = false;

    protected $fillable = [
        'tipo','tipoPessoal','tipoAcademico','$idFaseStock'
        ];

    public function faseStock(){
        return $this->belongsTo("App\FaseStock","idFaseStock");
    }
}
