<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsabilidade extends Model
{
    protected $table = 'Responsabilidade';

    protected $fillable = [
        'descricao','valorCliente','valorAgente','valorSubAgente',
        'valorUniversidade1','valorUniversidade2','imagem','$idFase','$idConta'
        ];

    public function conta(){
        return $this->belongsTo("App\Conta","idConta");
    }

    public function fase(){
        return $this->belongsTo("App\Fase","idFase");
    }

    public function relacao(){
        return $this->hasMany("App\RelFornResp","idResponsabilidade");
    }
}
