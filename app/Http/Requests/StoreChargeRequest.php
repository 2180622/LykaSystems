<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChargeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'valorRecebido' => 'required',
            'tipoPagamento' => 'required',
            'dataOperacao' => 'required',
            'dataRecebido' => 'required',
            'comprovativoPagamento' => 'nullable',
            'observacoes' => 'nullable'
        ];
    }
}
