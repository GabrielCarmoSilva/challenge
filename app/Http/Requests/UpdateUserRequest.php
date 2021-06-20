<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'min:6|string',
            'cpf' => 'string|min:11|regex:/^[0-9]+$/|unique:users,cpf,' . $this->user->id,
            'email' => 'email|unique:users,email,' . $this->user->id,
            'phone' => 'string',
            'password' => 'string|min:6',
        ];
    }
}
