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
            'tipo' => 'required|in:Licenciatura,Mestrado,Doutoramento,Curso de Verão,Estágio Profissional,Transferência de Curso,Curso Idiomas,Erasmus,Pré-Universitário',
            'anoAcademico' => 'required|max:255',
        ];
    }
}
