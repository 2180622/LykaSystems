<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUniversidadeRequest extends FormRequest
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
            "nome" => 'required|max:255',
            "morada" => 'required|max:255',
            "telefone" => '^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$|max:11',
            "email" => 'required',
            "NIF" => 'required',
            "IBAN" => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'O Título é obrigatório ser preenchido.',
            'morada.required' => 'A Morada é obrigatório ser preenchido.',
            'email.required' => 'O Endereço Eletrónico é obrigatório ser preenchido.',
            'NIF.required' => 'O NIF é obrigatório ser preenchido.',
            'IBAN.required' => 'O IBAN é obrigatório ser preenchido.'
        ];
    }
}
