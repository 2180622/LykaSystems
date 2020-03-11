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
            "morada" => '|max:255',
            "telefone" => 'max:11',
            "email" => '',
            "NIF" => '',
            "IBAN" => ''
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'O Título é obrigatório ser preenchido.',
        ];
    }
}
