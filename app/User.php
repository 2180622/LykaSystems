<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'User';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','tipo','password',
    ];

    public function admin(){
        return $this->belongsTo("App\Administrador","idAdmin")->withTrashed();
    }

    public function agente(){
        return $this->belongsTo("App\Agente","idAgente")->withTrashed();
    }

    public function cliente(){
        return $this->belongsTo("App\Cliente","idCliente");
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
