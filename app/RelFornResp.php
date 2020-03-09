<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelFornResp extends Model
{
    protected $table = 'RelFornResp';

    protected $fillable = [
        'valor','$idResponsabilidade','$idFornecedor'
        ];

    public function fornecedor(){
        return $this->belongsTo("App\Fornecedor","idFornecedor");
    }

    public function responsabilidade(){
        return $this->belongsTo("App\Responsabilidade","idResponsabilidade");
    }
}
