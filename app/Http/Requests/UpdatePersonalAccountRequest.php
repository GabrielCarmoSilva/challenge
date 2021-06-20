<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniquePersonalAccount;

class UpdatePersonalAccountRequest extends FormRequest
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
            'cpf' => 'string|min:11|regex:/^[0-9]+$/|unique:accounts,cpf,' . $this->account->id,
            'user_id' => ['exists:users,id', new UniquePersonalAccount(isset($this->user_id) ? $this->user_id : $this->account->user_id, "update", $this->account->id)]
        ];
    }
}
