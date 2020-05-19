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
        'beneficiario',
        'valorPago',
        'descricao',
        'comprovativoPagamento',
        'notaPagamento',
        'observacoes',
        '$idResponsabilidade',
        '$idConta'
    ];

    protected $dates = [
        'dataPagamento'
    ];

    public function responsabilidade(){
        return $this->belongsTo("App\Responsabilidade","idResponsabilidade","idResponsabilidade")->withTrashed();
    }

    public function conta(){
        return $this->belongsTo("App\Conta","idConta","idConta")->withTrashed();
    }
}
