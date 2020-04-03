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
        'subagent_agentid'=> 'nullable',
        'nome' => 'required',
        'apelido' => 'required',
        'email' => 'required|unique:Agente|unique:User',
        'dataNasc' => 'required',
        'fotografia' => 'nullable',
        'morada' => 'required',
        'pais' => 'required',
        'NIF' => 'required|unique:Agente',
        'telefoneW' => 'required',
        'telefone2' => 'nullable',
        'genero'=>'required',
        'tipo' => 'required|in:Agente,Subagente',
        ];
    }


    public function messages()
    {
       return [
       'email.unique'=>'Este e-mail já está registado. Insira um e-mail diferente',
       ];
    }



}

