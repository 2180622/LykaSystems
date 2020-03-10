<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelFornResp extends Model
{
    protected $table = 'RelFornResp';
    
    public $timestamps = false;

    protected $fillable = [
        'valor','$idResponsabilidade','$idFornecedor'
        ];

    public function fornecedor(){
        return $this->belongsTo("App\Fornecedor","idFornecedor")->withTrashed();
    }

    public function responsabilidade(){
        return $this->belongsTo("App\Responsabilidade","idResponsabilidade");
    }
}
