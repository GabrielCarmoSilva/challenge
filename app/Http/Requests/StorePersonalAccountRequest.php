<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniquePersonalAccount;

class StorePersonalAccountRequest extends FormRequest
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
            'cpf' => 'required|string|max:11|regex:/^[0-9]+$/|unique:accounts',
            'user_id' => ['required', 'exists:users,id', new UniquePersonalAccount($this->user_id, "store")]
        ];
    }
}
