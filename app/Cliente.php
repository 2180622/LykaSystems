<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'Cliente';
    protected $primaryKey = 'idCliente';
    public $timestamps = false;

    protected $fillable = [
        'nome','apelido','email','telefone1','telefone2','dataNasc','numCCid',
        'numPassaport','dataValidPP','localEmissaoPP','paisNaturalidade','morada',
        'cidade','moradaResidencia','passaportPaisEmi','nomePai','telefonePai',
        'emailPai','nomeMae','telefoneMae','emailMae','fotografia','NIF','IBAN',
        'nivEstudoAtual','nomeInstituicaoOrigem','cidadeInstituicaoOrigem',
        'obsPessoais','obsFinanceiras','obsAcademicas'
        ];

    public function user(){
        return $this->belongsTo("App\User","idUser","idUser");
    }

    public function produto(){
        return $this->hasMany("App\Produto","idCliente","idCliente");
    }
}
