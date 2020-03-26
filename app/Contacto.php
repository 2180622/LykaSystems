<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contacto extends Model
{
    protected $table = 'contacto';

    protected $primaryKey = 'idContacto';

    protected $fillable = [
        'nome','fotografia','telefone1','telefone2','email','telefone2','fax','observacao','favorito'];
}
