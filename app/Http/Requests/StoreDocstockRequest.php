<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreDocstockRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tipo' => 'required|in:Pessoal,Academico',
            'tipoPessoal' => 'in:Passaport,Cartão Cidadão,Carta Condução,Doc. Oficial',
            'tipoAcademico' => 'in:Exame Universitário,Exame Nacional,Diploma,Certificado',
        ];
    }
}