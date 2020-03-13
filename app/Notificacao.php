<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $table = 'Notificacao';

    protected $primaryKey = 'idNotificacao';

    protected $fillable = [
        'urgencia','tipo','dataInicio','dataFim','assunto','descricao','$idUser',
        ];

    public function user(){
        return $this->belongsTo("App\User","idUser","idUser");
    }
}
