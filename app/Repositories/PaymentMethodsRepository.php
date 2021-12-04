<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PaymentMethodsRepository
{
//
//    public function getAllCurrenciesIds(): array
//    {
//        $currencies = Currency::all();
//        $currenciesIds = [];
//        foreach ($currencies as $currency)
//            $currenciesIds[$currency->id] = true;
//        return $currenciesIds;
//    }

    public function rules(): array
    {
        return [
            "name"              => ["required",  "max:255"],
            "currencies"        => ["required", "exists:currencies,id"],
            "currencies.*"      => ["required"],
            "min_deposit"       => ["required", "numeric", "min:1"],
            "max_deposit"       => ["required", "numeric", "gt:min_deposit"],
            "min_withdrawal"       => ["required", "numeric", "min:1"],
            "max_withdrawal"       => ["required", "numeric", "gt:min_withdrawal"],
            "icon"              => ["required", "image", "max:4096", "mimes:png,svg"]
        ];
    }

    public function columns(): array
    {
        return [
            "name" => "payment method name",
            "currencies" => "currencies supported"
        ];
    }

    public function updateRules(Request $request): array
    {
        $rules = $this->rules();
        if(!$request->file("icon"))
            unset($rules["icon"]);
        return $rules;
    }

    public function validation(Request $request, array $rules): array
    {
        $result["fails"] = false;
        $valid = Validator::make($request->all(), $rules);
        if($valid->fails()){
            $result["fails"] = true;
            $result["messages"] = $valid->errors()->messages();
            $request->request->add(["currenciesSelected" =>  array_flip($request->currencies)]);
            $request->request->remove("currencies");
            $result["inputs"] = $request->all();
        }
        return $result;
    }

    public function editPage(Request $request, $id): array
    {
        $data["currencies"] = Currency::all();
        $data["paymentMethod"] = $paymentMethod = PaymentMethod::findOrFail($id);
        $currencies = [];
        if(!$request->old("currenciesSelected"))
            foreach ($paymentMethod->currencies as $currency)
                $currencies[$currency->id] = true;
        else
            $currencies = $request->old("currenciesSelected");
        $data["currenciesSelected"] = $currencies;
        unset($currencies, $paymentMethod);
        return $data;
    }

    public function createPaymentMethod(Request $request){
        $this->savePaymentMethod(new PaymentMethod(), $request);
    }

    public function savePaymentMethod(PaymentMethod $paymentMethod, Request $request){
        $paymentMethod->name = $request->name;
        $paymentMethod->min_deposit = $request->min_deposit;
        $paymentMethod->max_deposit = $request->max_deposit;
        $paymentMethod->min_withdrawal = $request->min_withdrawal;
        $paymentMethod->max_withdrawal = $request->max_withdrawal;
        $paymentMethod->save();
        if($request->file("icon")){
            if($paymentMethod->getFirstMedia('icon'))
                $paymentMethod->removeGroupMedia('icon');
            $paymentMethod->saveMedia($request->file("icon"), 'icon');
        }
        $paymentMethod->currencies()->sync($request->currencies);
    }

    public function deletePaymentMethod(PaymentMethod $paymentMethod){
        $paymentMethod->removeAllMedia();
        $paymentMethod->delete();
    }

}
