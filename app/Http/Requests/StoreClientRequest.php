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
          'numCCid' => 'required|unique:Cliente',
          'numPassaport' => 'required|unique:Cliente',
          'dataValidPP' => 'required',
          'localEmissaoPP' => 'required',
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
          'NIF' => 'required|unique:Cliente',
          'IBAN' => 'required',
          'nivEstudoAtual' => 'required',
          'nomeInstituicaoOrigem' => 'required',
          'cidadeInstituicaoOrigem' => 'required',
          'obsPessoais' => 'nullable',
          'obsAcademicas' => 'nullable',
          'obsFinanceiras' => 'nullable',
        ];
    }


    public function messages()
    {
       return [
       'email.unique'=>'Este e-mail já está registado. Insira um e-mail diferente',
       ];
    }



}
