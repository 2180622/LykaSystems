<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'idAgente' => 'nullable',
            'nome' => 'required',
            'apelido' => 'required',
            'genero'=>'required',
            'email' => 'required|unique:Cliente|unique:Agente|unique:User',
            'telefone1' => 'nullable',
            'telefone2' => 'nullable',
            'dataNasc' => 'nullable',
            'paisNaturalidade' => 'nullable',
            'morada' => 'nullable',
            'cidade' => 'nullable',
            'moradaResidencia' => 'nullable',


            'nomePai' => 'nullable',
            'telefonePai'  => 'nullable',
            'emailPai' => 'nullable',
            'nomeMae' => 'nullable',
            'telefoneMae' => 'nullable',
            'emailMae' => 'nullable',
            'fotografia' => 'nullable',
            'NIF' => 'nullable',
            'IBAN' => 'nullable',
            'nivEstudoAtual' => 'nullable',
            'nomeInstituicaoOrigem' => 'nullable',
            'cidadeInstituicaoOrigem' => 'nullable',

            'num_docOficial'=> 'required|unique:Cliente',
            'validade_docOficial'=> 'nullable', /* data de validade do CC */
            'img_docOficial'=> 'nullable',

            'num_passaporte'=> 'required',
            'dataValidPP'=> 'nullable',
            'passaportePaisEmi'=> 'nullable',
            'localEmissaoPP'=> 'nullable',
            'img_Passaporte'=> 'nullable',


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
