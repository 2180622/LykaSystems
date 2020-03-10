<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdministradorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'nome' => 'required',
            'apelido' => 'required',
            'email' => 'required',
            'dataNasc' => 'required',
            'fotografia' => 'nullable',
            'telefone1' => 'required',
            'telefone2' => 'nullable',
            'dataRegis'=> 'required',
        ];
    }
}
