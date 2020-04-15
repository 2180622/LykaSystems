<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'genero'=>'required',
            'email' => 'required|unique:Cliente|unique:Agente',
            'telefone1' => 'required',
            'telefone2' => 'nullable',
            'dataNasc' => 'required',
            'paisNaturalidade' => 'required',
            'morada' => 'required',
            'cidade' => 'required',
            'moradaResidencia' => 'required',
            'passaportPaisEmi' => 'required',
            'nomePai' => 'nullable',
            'telefonePai'  => 'nullable',
            'emailPai' => 'nullable',
            'nomeMae' => 'nullable',
            'telefoneMae' => 'nullable',
            'emailMae' => 'nullable',
            'fotografia' => 'nullable',
            'NIF' => 'nullable',
            'IBAN' => 'required',
            'nivEstudoAtual' => 'required',
            'nomeInstituicaoOrigem' => 'required',
            'cidadeInstituicaoOrigem' => 'required',

            'num_docOficial'=> 'required|unique:Cliente',
            'dataValidade_docOficial'=> 'nullable',
            'img_docOficial'=> 'nullable',
            'info_docOficial'=> 'nullable',

            'img_Passaport'=> 'nullable',
            'info_Passaport'=> 'nullable',

            'img_docAcademico'=> 'nullable',
            'info_docAcademico'=> 'nullable',

            'obsPessoais' => 'nullable',
            'obsFinanceiras' => 'nullable',
            'obsAcademicas' => 'nullable',

        ];
    }


    public function messages()
    {
       return [
       'email.unique'=>'Este e-mail já está registado. Insira um e-mail diferente',
       ];
    }



}
