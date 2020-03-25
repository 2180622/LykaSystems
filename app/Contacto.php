<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Contacto extends Model
{

    protected $table = 'contacto';

    protected $primaryKey = 'idContacto';

    protected $fillable = [
        'nome','fotografia','telefone1','telefone2','email','fax','observacao','favorito'
        ];
}
