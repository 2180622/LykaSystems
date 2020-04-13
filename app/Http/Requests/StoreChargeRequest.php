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
            'valorRecebido' => 'required|regex:/^((\d+)|(\d{1,3}(\.\d{3})+)|(\d{1,3}(\.\d{3})(\,\d{3})+))(\,\d{2})?$/',
            'tipoPagamento' => 'required',
            'dataOperacao' => 'required',
            'dataRecebido' => 'required',
            'comprovativoPagamento' => 'nullable',
            'observacoes' => 'nullable'
        ];
    }

    public function messages()
    {
      return[
        'valorRecebido.required' => 'O campo Valor Recebido necessita de um valor.',
        'valorRecebido.regex' => 'O campo Valor Recebido deve ter o seguinte formato: 10,00 ou 10.000.'
      ];
    }
}
