<?php

namespace App\Rules;

use App\Models\PaymentMethod;
use Illuminate\Contracts\Validation\Rule;

class CheckCurrencyIsSupportedForPaymentMethod implements Rule
{
    protected PaymentMethod $paymentMethod;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
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
        return ($this->paymentMethod->currencies()->where("currencies.id", $value)->first()) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The currency is not support for payment method';
    }
}
