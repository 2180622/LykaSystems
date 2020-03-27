<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgenteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'nome' => 'required',
          'apelido' => 'required',
          'genero'=>'required',
          'email' => 'required|unique:agente|unique:user|unique:cliente',
          'dataNasc' => 'required',
          'fotografia' => 'nullable',
          'morada' => 'required',
          'pais' => 'required',
          'NIF' => 'required|unique:agente',
          'telefoneW' => 'required',
          'telefone2' => 'nullable',
          'tipo' => 'required|in:Agente,Subagente',
        ];
    }
}

