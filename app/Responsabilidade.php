<?php

namespace App;

use App\Events\StorePayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Responsabilidade extends Model
{
    use SoftDeletes;
    protected $table = 'Responsabilidade';

    protected $primaryKey = 'idResponsabilidade';

    protected $fillable = [
        'valorCliente','valorAgente','valorSubAgente','valorUniversidade1',
        'valorUniversidade2','verificacaoPagoCliente','verificacaoPagoAgente',
        'verificacaoPagoSubAgente','verificacaoPagoUni1','verificacaoPagoUni2'
        ];

    public function fase(){
        return $this->belongsTo("App\Fase","idResponsabilidade","idResponsabilidade")->withTrashed();
    }

    public function relacao(){
        return $this->hasMany("App\RelFornResp","idResponsabilidade","idResponsabilidade");
    }

    protected $dispatchesEvents = [
        'updated' => StorePayment::class,
    ];
}
