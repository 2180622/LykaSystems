<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
          'username' => 'required|min:3|max:40|regex:/^[A-ZÀ-úa-z\s]+$/',
          'tipo' => 'required|in:admin,agente,cliente',
          'password_hash' => 'required',
          'password_reset_token' => 'nullable',
          'verification_token' => 'nullable',
          'auth_key' => 'required',
          'status' => 'required',
          'created_at' => 'required',
          'idAmin' => 'nullable',
          'idAgente' => 'nullable',
          'idCliente' => 'nullable',
        ];
    }

    public function messages()
    {
       return [
       'name.regex' => 'Name should contain only letters and spaces'
       ];
    }
}
