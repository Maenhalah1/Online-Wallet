<?php

namespace App\Repositories;


use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionRepository
{

    public function changeStatus(Request $request){
        $transaction = Transaction::selectBuilder()->waiting()->byId($request->transactionId)->first();
        if(!$transaction || !in_array($request->status, ['1', '0']))
            return false;
        return $request->status === '1' ? $this->accept($transaction) : $this->reject($transaction);
    }

    protected function accept($transaction){
        $wallet = $transaction->user->wallet;
        if($transaction->type == "d")
            $wallet->total_amount += $transaction->amount;
        else
            $wallet->total_amount -= $transaction->amount;
        $wallet->save();
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
