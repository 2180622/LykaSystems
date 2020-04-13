<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelFornResp extends Model
{
    use SoftDeletes;
    protected $table = 'RelFornResp';

    protected $primaryKey = 'idRelacao';

    protected $fillable = [
        'valor','verificacaoPago','$idResponsabilidade','$idFornecedor','$idConta'
        ];

    public function fornecedor(){
        return $this->belongsTo("App\Fornecedor","idFornecedor","idFornecedor")->withTrashed();
    }

    public function responsabilidade(){
        return $this->belongsTo("App\Responsabilidade","idResponsabilidade","idResponsabilidade")->withTrashed();
    }

    public function conta(){
        return $this->belongsTo("App\Conta","idConta","idConta")->withTrashed();
    }
}
