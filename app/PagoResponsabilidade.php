<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoResponsabilidade extends Model
{
    protected $table = 'PagoResponsabilidade';

    protected $primaryKey = 'idPagoResp';

    protected $fillable = [
        'data','nomeAutor','imagem','$idFase'
        ];

    public function fase(){
        return $this->belongsTo("App\Fase","idFase","idFase");
    }

    public function conta(){
        return $this->belongsTo("App\Conta","idConta","idConta");
    }
}
