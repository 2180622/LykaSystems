<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreAgenteRequest extends FormRequest
{
    public function authorize(){
        return true;
    }


    public function rules(){

        return [
          'nome' => 'required',
          'apelido' => 'required',
          'email' => 'required',
          'dataNasc' => 'required',
          'morada' => 'required',
          'pais' => 'required',
          'NIF' => 'required',
          'tipo' => 'required|in:Agente,Subagente',
          'telefoneW' => 'required',
          'telefone2' => 'nullable',
        ];
    }
}
