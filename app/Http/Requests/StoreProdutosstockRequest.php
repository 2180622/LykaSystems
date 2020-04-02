<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreProdutosstockRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'descricao' => 'required|max:255',
            'tipo' => 'required|max:255',
            'anoAcademico' => 'required|max:255',
        ];
    }
}
