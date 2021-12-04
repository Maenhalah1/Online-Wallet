<?php

namespace App\Repositories;


use App\Models\Currency;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use App\Rules\CheckCurrencyIsSupportedForPaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionRepository
{
    public function getUserTransaction($userId){
        return Transaction::selectBuilder()->forUser($userId)->get();
    }

    public function rules(Request $request, ?PaymentMethod $paymentMethod, ?Currency $currency): array
    {
        $rules = [
            "type" => ["required", "in:d,w"],
            "payment_method" => ["required", "exists:payment_methods,id"],
            "amount"    => ["required", "numeric"],
            "currency"    => ["required"]
        ];
        if($paymentMethod)
            $rules["currency"][] = new CheckCurrencyIsSupportedForPaymentMethod($paymentMethod);

        if($paymentMethod && in_array($request->type, ["d", "w"]) && $currency){
            $rules["amount"][] = "min:" . ($request->type == "d" ? $paymentMethod->min_deposit * $currency->difference_in_dollar : $paymentMethod->min_withdrawal * $currency->difference_in_dollar);
            $rules["amount"][] = "max:" . ($request->type == "d" ? $paymentMethod->max_deposit * $currency->difference_in_dollar : $paymentMethod->max_withdrawal * $currency->difference_in_dollar);
            if($request->type == "w")
                $rules["amount"][] = "max:" . Auth::guard("api")->user()->wallet->total_amount * $currency->difference_in_dollar;
        }
        return $rules;
    }

    public function validation(Request $request): array
    {
        $currency = null;
        $paymentMethod = PaymentMethod::find($request->payment_method);
        if($paymentMethod)
            $currency = $paymentMethod->currencies()->where("currencies.id", $request->currency)->first();

        $result["fails"] = false;
        $valid = Validator::make($request->all(), $this->rules($request, $paymentMethod, $currency));
        if($valid->fails()){
            $result["fails"] = true;
            $result["messages"] = $valid->errors()->messages();
        }else{
            $result["paymentMethod"] = $paymentMethod;
            $result["currency"] = $currency;
        }
        return $result;
    }

    public function createTransaction(Request $request, ?Currency $currency){
        $transaction = new Transaction();
        $transaction->amount = $request->amount / $currency->difference_in_dollar;
        $transaction->type = $request->type;
        $transaction->payment_method_id = $request->payment_method;
        $transaction->user_id = Auth::guard("api")->user()->id;
        $transaction->save();
    }

    public function changeStatus(Request $request){
        $transaction = Transaction::selectBuilder()->waiting()->byId($request->transactionId)->first();
        if(!$transaction || !in_array($request->status, ['1', '0']))
            return false;
        return $request->status === '1' ? $this->accept($transaction) : $this->reject($transaction);
    }

    protected function accept($transaction){
        $walletRepo = new WalletRepository();
        $walletRepo->updateWallet($transaction->user->wallet,  $transaction->amount, $transaction->type);
        $transaction->status = 1;
        return $transaction->save();
    }

    protected function reject($transaction){
        $transaction->status = 0;
        return $transaction->save();
    }

    public function filter(Request $request){
        $transactionQuery = Transaction::selectBuilder();
        if(in_array($request->status, ['-1', '1', '0']))
            $transactionQuery->status((int)$request->status);

        if(in_array($request->type, ['d', 'w']))
            $transactionQuery->type($request->type);

        return $transactionQuery->get();
    }

}
