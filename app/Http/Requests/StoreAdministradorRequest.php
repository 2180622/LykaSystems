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
            'telefone1' => 'required',
            'telefone2' => 'nullable',
        ];
    }

    public function messages()
    {
       return [
       'nome.required' => 'O nome deve ser preenchido corretamente.',
       'apelido.required' => 'O apelido deve ser preenchido corretamente.',
       'dataNasc.required' => 'A data deve ser preenchida corretamente.',
       'telefone1.required' => 'O telefone deve ser preenchido corretamente.'
       ];
    }
}
