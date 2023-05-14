<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[0-9A-Za-z.\s,\'-]*$/',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users|regex:/^[0-9A-Za-z.\s,\'-]*$/',
            'password' => 'required|regex:/^[0-9A-Za-z.\s,\'-]*$/',
            're_password'=>'required|same:password'

        ];
    }
}
