<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{

    use Notifiable;
    protected $table = 'User';
    
    protected $primaryKey = 'idUser';

    protected $fillable = [
        'email','tipo','password',
    ];

    public function admin(){
        return $this->belongsTo("App\Administrador","idAdmin","idAdmin")->withTrashed();
    }

    public function agente(){
        return $this->belongsTo("App\Agente","idAgente","idAgente")->withTrashed();
    }

    public function cliente(){
        return $this->belongsTo("App\Cliente","idCliente","idCliente");
    }

    public function notificacao(){
        return $this->hasMany("App\Notificacao","idUser","idUser");
    }
}
