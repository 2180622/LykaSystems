<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
          'email' => 'required|unique:user',
          'password' => 'nullable',
        ];
    }

    public function messages()
    {
       return [
       'email.required' => 'O e-mail deve ser preenchido corretamente.'
       ];
    }
}
