<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fase extends Model
{
    use HasSlug;
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
        return $this->hasMany("App\DocTransacao","idFase","idFase");
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

    public function getSlugOptions() : SlugOptions
    {
      return SlugOptions::create()
          ->generateSlugsFrom('descricao')
          ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
