<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelFornResp extends Model
{
    protected $table = 'RelFornResp';

    protected $primaryKey = 'idRelacao';

    protected $fillable = [
        'valor','$idResponsabilidade','$idFornecedor'
        ];

    public function fornecedor(){
        return $this->belongsTo("App\Fornecedor","idFornecedor","idFornecedor")->withTrashed();
    }

    public function responsabilidade(){
        return $this->belongsTo("App\Responsabilidade","idResponsabilidade","idResponsabilidade");
    }
}
