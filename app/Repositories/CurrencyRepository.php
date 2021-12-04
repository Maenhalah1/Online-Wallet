<?php

namespace App\Repositories;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyRepository
{

    public function rules(): array
    {
        return [
            "name"                  => ["required", "unique:currencies", "max:255"],
            "code"                  => ["required", "unique:currencies", "max:255"],
            "difference_in_dollar"  => ["required", "numeric"],
        ];
    }

    public function columns(): array
    {
        return [
            "name"                  => 'currency name',
            "code"                  => 'currency code',
        ];
    }

    public function updateRules(Request $request, Currency $currency){
        $rules = $this->rules();
        if($request->name === $currency->name)
            unset($rules["name"]);
        if($request->code === $currency->code)
            unset($rules["code"]);
        return $rules;
    }

    public function createCurrency(Request $request){
        $this->saveCurrency(new Currency(), $request);
    }

    public function saveCurrency(Currency $currency, Request $request){
        $currency->name = $request->name;
        $currency->code = strtoupper($request->code);
        $currency->difference_in_dollar = $request->difference_in_dollar;
        $currency->save();
    }
}
