<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $table = 'Cliente';

    protected $primaryKey = 'idCliente';

    protected $fillable = [
        'nome','apelido','genero','email','telefone1','telefone2','dataNasc',
        'paisNaturalidade','morada',
        'cidade','moradaResidencia','nomePai','telefonePai',
        'emailPai','nomeMae','telefoneMae','emailMae','fotografia','NIF','IBAN',
        'nivEstudoAtual','nomeInstituicaoOrigem','cidadeInstituicaoOrigem',
        'obsPessoais','obsFinanceiras','obsAcademicas','num_docOficial','img_docOficial','dataValidade_docOficial','info_docOficial',
        'img_Passaport','info_Passaport','img_docAcademico','info_docAcademico'
        ];

        /* !!!!!!!!!!! TENS QUE AVISAR QUANDO MUDAS ISTO !!!!!!!!!!!!!!!!!!!!!!!! */

        
    public function user(){
        return $this->belongsTo("App\User","idUser","idUser")->withTrashed();
    }

    public function produto(){
        return $this->hasMany("App\Produto","idCliente","idCliente")->withTrashed();
    }
}
