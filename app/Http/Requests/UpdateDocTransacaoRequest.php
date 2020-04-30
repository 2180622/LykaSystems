<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocTransacaoRequest extends FormRequest
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
            'descricao	'=> 'required',
            'valorRecebido'=> 'required',
            'tipoPagamento' => 'required',
            'dataOperacao' => 'required',
            'dataRecebido' => 'nullable',
            'obsevacoes' => 'nullable',
            'comprovativoPagamento' => 'nullable',
            'idConta' => 'required',
        ];
    }
}
