<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
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
            'email' => 'required',
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

            'num_docOficial'=> 'required',
            'dataValidade_docOficial'=> 'nullable',
            'img_docOficial'=> 'nullable',
            'info_docOficial'=> 'nullable',

            'img_Passaport'=> 'nullable',
            'numPassaport'=> 'nullable',
            'dataValidPP'=> 'nullable',
            'passaportPaisEmi'=> 'nullable',
            'localEmissaoPP'=> 'nullable',

            'img_docAcademico'=> 'nullable',
            'info_docAcademico'=> 'nullable',

            'obsPessoais' => 'nullable',
            'obsFinanceiras' => 'nullable',
            'obsAcademicas' => 'nullable',

        ];
    }
}
