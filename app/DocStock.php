<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocStock extends Model
{
    use SoftDeletes;
    protected $table = 'DocStock';
    
    public $timestamps = false;

    protected $fillable = [
        'tipo','tipoPessoal','tipoAcademico','$idFaseStock'
        ];

    public function faseStock(){
        return $this->belongsTo("App\FaseStock","idFaseStock");
    }
}
