<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'Agenda';

    protected $primaryKey = 'idAgenda';

    protected $fillable = [
        'descricao','visibilidade','dataInicio','dataFim','$idUser'
    ];

    public function user(){
        return $this->belongsTo("App\User","idUser","idUser");
    }
}
