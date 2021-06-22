<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TransactionType implements Rule
{
    public $type;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        $this->type = $type;
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
        $types = ['Pagamento de Conta', 'Depósito', 'Transferência', 'Recarga de Celular', 'Compra (Crédito)'];
        if(!in_array($this->type, $types)) {
            return false;
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
        return 'O tipo de transação não é válido. Digite Pagamento de Conta, Depósito,
        Transferência, Recarga de Celular ou Compra (Crédito).';
    }
}
