<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoResponsabilidade extends Model
{
    protected $table = 'PagoResponsabilidade';
    
    public $timestamps = false;

    protected $fillable = [
        'data','nomeAutor','imagem','$idFase'
        ];

    public function fase(){
        return $this->belongsTo("App\Fase","idFase");
    }
}
