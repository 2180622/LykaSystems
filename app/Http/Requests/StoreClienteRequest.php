<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
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
          'telefone1' => 'required',
          'telefone2' => 'nullable',
          'dataNasc' => 'required',
          'numCCid' => 'required',
          'numPassaport' => 'required',
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
          'NIF' => 'required',
          'IBAN' => 'required',
          'nivEstudoAtual' => 'required',
          'nomeInstituicaoOrigem' => 'required',
          'cidadeInstituicaoOrigem' => 'required',
        ];
    }
}
