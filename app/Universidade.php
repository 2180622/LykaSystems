<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Universidade extends Model
{
    protected $table = 'Universidade';

    protected $primaryKey = 'idUniversidade';

    protected $fillable = [
        'nome', 'morada', 'telefone', 'email', 'NIF', 'IBAN', 'obsContactos', 'obsCursos', 'obsCandidaturas',
    ];

    public function user()
    {
        return $this->belongsTo("App\User", "idUser", "idUser")->withTrashed();
    }

    public function produto()
    {
        return $this->hasMany("App\Produto", "idUniversidade1", "idUniversidade")->withTrashed();
    }

    public function produto2()
    {
        return $this->hasMany("App\Produto", "idUniversidade2", "idUniversidade")->withTrashed();
    }

    public function responsabilidade()
    {
        return $this->hasMany("App\Responsabilidade", "idUniversidade1", "idUniversidade")->withTrashed();
    }

    public function responsabilidade2()
    {
        return $this->hasMany("App\Responsabilidade", "idUniversidade2", "idUniversidade")->withTrashed();
    }

    public function contacto()
    {
        return $this->hasMany("App\Contacto", "idUniversidade", "idUniversidade");
    }

    use SoftDeletes;
}
