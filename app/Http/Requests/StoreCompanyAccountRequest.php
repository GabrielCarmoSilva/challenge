<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueCompanyAccount;

class StoreCompanyAccountRequest extends FormRequest
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
            'social_reason' => 'required|string',
            'fantasy_name' => 'required|string',
            'cnpj' => 'required|unique:accounts|max:14|regex:/^[0-9]+$/',
            'user_id' => ['required', 'exists:users,id', new UniqueCompanyAccount($this->user_id, "store")]
        ];
    }
}
