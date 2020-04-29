<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagoResponsabilidade extends Model
{
    use SoftDeletes;
    
    protected $table = 'PagoResponsabilidade';

    protected $primaryKey = 'idPagoResp';

    protected $fillable = [
      'beneficiario', 'comprovativoPagamento', 'dataPagamento', '$idFase', '$idConta'
    ];

    public function fase(){
        return $this->belongsTo("App\Fase","idFase","idFase")->withTrashed();
    }

    public function conta(){
        return $this->belongsTo("App\Conta","idConta","idConta")->withTrashed();
    }
}
