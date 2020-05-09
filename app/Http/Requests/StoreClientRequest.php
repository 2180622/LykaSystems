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
            'email' => 'required|unique:Cliente|unique:Agente',
            'telefone1' => 'required',
            'telefone2' => 'nullable',
            'dataNasc' => 'required',
            'paisNaturalidade' => 'required',
            'morada' => 'required',
            'cidade' => 'required',
            'moradaResidencia' => 'required',
            'passaportePaisEmi' => 'required',
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
            'img_docOficial'=> 'nullable',
            'info_docOficial'=> 'nullable',

            'img_Passaporte'=> 'nullable',
            'numPassaporte'=> 'nullable',
            'dataValidPP'=> 'nullable',
            'passaportePaisEmi'=> 'nullable',
            'localEmissaoPP'=> 'nullable',

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
