<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;


class Biblioteca extends Model
{
    use HasSlug;

    protected $table = 'Biblioteca';

    protected $primaryKey = 'idBiblioteca';

    protected $fillable = [
        'acesso','descricao','ficheiro','tipo','tamanho'
        ];



        /* URL */

        public function getSlugOptions() : SlugOptions
        {
          return SlugOptions::create()
              ->generateSlugsFrom('ficheiro')
              ->saveSlugsTo('slug');
        }

        public function getRouteKeyName()
        {
            return 'slug';
        }

}
