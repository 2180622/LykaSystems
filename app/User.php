<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{

    use Notifiable;
    use SoftDeletes;
    protected $table = 'User';

    protected $primaryKey = 'idUser';

    protected $fillable = [
        'email','tipo','password','$idAdmin','$idAgente','$idCliente'
    ];

    public function admin(){
        return $this->belongsTo("App\Administrador","idAdmin","idAdmin")->withTrashed();
    }

    public function agente(){
        return $this->belongsTo("App\Agente","idAgente","idAgente")->withTrashed();
    }

    public function cliente(){
        return $this->belongsTo("App\Cliente","idCliente","idCliente")->withTrashed();
    }

    public function contacto(){
        return $this->hasMany("App\Contacto","idUser","idUser");
    }
}
