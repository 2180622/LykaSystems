<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contacto extends Model
{
    protected $table = 'Contacto';

    protected $primaryKey = 'idContacto';

    protected $fillable = [
        'idUniversidade','nome','fotografia','telefone1','telefone2','email','fax','observacao',
        'favorito','visibilidade','idUser','idUniversidade'
    ];
    public function user(){
        return $this->belongsTo("App\User","idUser","idUser")->withTrashed();
    }
    public function universidade(){
        return $this->belongsTo("App\Universidade","idUniversidade","idUniversidade")->withTrashed();
    }
}
