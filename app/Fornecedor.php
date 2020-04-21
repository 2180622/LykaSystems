<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use HasSlug;
    use SoftDeletes;
    protected $table = 'Fornecedor';

    protected $primaryKey = 'idFornecedor';

    protected $fillable = [
      'nome', 'morada', 'contacto', 'descricao', 'observacoes'
    ];

    public function relacao(){
        return $this->hasMany("App\RelFormResp","idFornecedor","idFornecedor");
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
