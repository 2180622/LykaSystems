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
        'dataValidPP','localEmissaoPP','paisNaturalidade','morada',
        'cidade','moradaResidencia','passaportPaisEmi','nomePai','telefonePai',
        'emailPai','nomeMae','telefoneMae','emailMae','fotografia','NIF','IBAN',
        'nivEstudoAtual','nomeInstituicaoOrigem','cidadeInstituicaoOrigem',
        'obsPessoais','obsFinanceiras','obsAcademicas','num_doc','$idDocOficial',
        '$idDocPassaport','$idDocAcademico'
        ];

    public function user(){
        return $this->belongsTo("App\User","idUser","idUser")->withTrashed();
    }

    public function docPessoal(){
        return $this->hasMany("App\DocPessoal","idUser","idUser");
    }
    public function docAcademico(){
        return $this->hasMany("App\DocAcademico","idUser","idUser");
    }

    public function produto(){
        return $this->hasMany("App\Produto","idCliente","idCliente")->withTrashed();
    }
}
