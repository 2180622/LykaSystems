<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;

class Responsabilidade extends Model
{
    use HasSlug;
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
