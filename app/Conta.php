<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conta extends Model
{
    use SoftDeletes;
    protected $table = 'Conta';

    protected $primaryKey = 'idConta';

    protected $fillable = [
        'descricao', 'instituicao', 'titular', 'morada', 'numConta', 'IBAN', 'SWIFT', 'contacto', 'obsConta'
    ];

    public function pagoResponsabilidade(){
        return $this->hasMany("App\PagoResponsabilidade","idPagoResp","idPagoResp")->withTrashed();
    }

    public function docTransacao(){
        return $this->hasMany("App\DocTransacao","idConta","idConta")->withTrashed();
    }
}
