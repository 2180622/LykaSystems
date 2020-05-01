<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class DocPessoal extends Model
{
    use HasSlug;
    protected $table = 'DocPessoal';

    protected $primaryKey = 'idDocPessoal';

    protected $fillable = [
        'idCliente','tipo','imagem','info','dataValidade','verificacao','$idFase'
        ];

    public function fase(){
        return $this->belongsTo("App\Fase","idFase","idFase")->withTrashed();
    }

    public function getSlugOptions() : SlugOptions
    {
      return SlugOptions::create()
          ->generateSlugsFrom('tipo')
          ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
