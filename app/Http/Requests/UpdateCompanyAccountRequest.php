<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueCompanyAccount;

class UpdateCompanyAccountRequest extends FormRequest
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
            'social_reason' => 'string',
            'fantasy_name' => 'string',
            'cnpj' => 'string|max:14|regex:/^[0-9]+$/|unique:accounts,cnpj,' . $this->account->id,
            'user_id' => ['exists:users,id', new UniqueCompanyAccount(isset($this->user_id) ? $this->user_id : $this->account->user_id, "update", $this->account->id)]
        ];
    }
}
