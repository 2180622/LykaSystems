<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    use SoftDeletes;
    protected $table = 'Fase';

    protected $primaryKey = 'idFase';

    protected $fillable = [
        'descricao','dataVencimento','valorFase','verificacaoPago','$idProduto','$idFaseStock','$idResponsabilidade'
        ];

    public function produto(){
        return $this->belongsTo("App\Produto","idProduto","idProduto")->withTrashed();
    }

    public function responsabilidade(){
        return $this->belongsTo("App\Responsabilidade","idResponsabilidade","idResponsabilidade")->withTrashed();
    }

    public function docTransacao(){
        return $this->hasMany("App\DocTransacao","idFase","idFase")->withTrashed();
    }

    public function docAcademico(){
        return $this->hasMany("App\DocAcademico","idFase","idFase");
    }

    public function docPessoal(){
        return $this->hasMany("App\DocPessoal","idFase","idFase");
    }

    public function pagoResponsabilidade(){
        return $this->belongsTo("App\PagoResponsabilidade","idFase","idFase")->withTrashed();
    }

    public function faseStock(){
        return $this->belongsTo("App\FaseStock","idFaseStock","idFaseStock")->withTrashed();
    }
}
