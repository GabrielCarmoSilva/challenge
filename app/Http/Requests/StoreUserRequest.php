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
            'name' => 'required|string|min:6',
            'email' => 'required|email|unique:users',
            'cpf' => 'required|string|max:11|unique:users|regex:/^[0-9]+$/',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6',
        ];
    }
}
