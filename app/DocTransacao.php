<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocTransacao extends Model
{
    use SoftDeletes;
    protected $table = 'DocTransacao';

    protected $primaryKey = 'idDocTransacao';

    protected $fillable = [
        'descricao','valorRecebido','dataOperacao','dataRecebido','verificacao','observacoes','tipoPagamento',
        'comprovativoPagamento','$idConta','$idFase'
        ];

    public function fase(){
        return $this->belongsTo("App\Fase","idFase","idFase")->withTrashed();
    }

    public function conta(){
        return $this->belongsTo("App\Conta","idConta","idConta")->withTrashed();
    }
}
