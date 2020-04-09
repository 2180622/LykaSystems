<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgenteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

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
        'num_id'=> 'required|unique:Agente',
        'NIF' => 'required|unique:Agente',
        'doc_img' => 'nullable',
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
