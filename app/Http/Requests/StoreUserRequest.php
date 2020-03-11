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
          'email' => 'required',
          // 'username' => 'required|min:3|max:40|regex:/^[A-ZÀ-úa-z\s]+$/',
          'password' => 'nullable',
        ];
    }

    public function messages()
    {
       return [
       'username.required' => 'Name should contain only letters and spaces'
       ];
    }
}
