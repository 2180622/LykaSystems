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

    public function docOficial(){
        return $this->belongsTo("App\DocPessoal","idDocPessoal","idDocOficial");
    }
    public function docPassaport(){
        return $this->belongsTo("App\DocPessoal","idDocPessoal","idDocPassaport");
    }
    public function docAcademico(){
        return $this->belongsTo("App\DocAcademico","idDocAcademico","idDocAcademico");
    }

    public function produto(){
        return $this->hasMany("App\Produto","idCliente","idCliente")->withTrashed();
    }
}
