<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;

class UniquePersonalAccount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public $user_id;
    public $method;
    public $account_id;
     
    public function __construct($user_id, $method, $account_id = null)
    {
        $this->user_id = $user_id;
        $this->method = $method;
        $this->account_id = $account_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::where('id', '=', $this->user_id)->first();
        if($this->method == "store") {
            if(count($user->accounts()->where('type', 'Pessoal')->get()) > 0) {
                return false;
            }
        }
        else if($this->method == "update") {
            if(count($user->accounts()->where('type', 'Pessoal')->get()) > 0) {
                if(!($user->accounts()->where('type', 'Pessoal')->first()->id == $this->account_id)) {
                    return false;
                }
            }    
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O usuário só pode ter uma conta pessoal.';
    }
}
