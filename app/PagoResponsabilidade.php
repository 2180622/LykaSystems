<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoResponsabilidade extends Model
{
    use SoftDeletes;
    protected $table = 'PagoResponsabilidade';

    protected $primaryKey = 'idPagoResp';

    protected $fillable = [
        'data','nomeAutor','imagem','$idFase','$idConta'
        ];

    public function fase(){
        return $this->belongsTo("App\Fase","idFase","idFase")->withTrashed();
    }

    public function conta(){
        return $this->belongsTo("App\Conta","idConta","idConta")->withTrashed();
    }
}
