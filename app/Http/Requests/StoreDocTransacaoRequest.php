<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreDocTransacaoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'descricao	'=> 'required',
            'valorRecebido'=> 'required',
            'tipoPagamento' => 'required',
            'dataOperacao' => 'required',
            'dataRecebido' => 'nullable',
            'obsevacoes' => 'nullable',
            'idConta' => 'required',
        ];
    }
}
