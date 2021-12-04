<?php

namespace App\Repositories;

use App\Http\Resources\WalletResource;
use App\Models\User;
use App\Models\Wallet;

class WalletRepository
{

    public function createWallet($userId, $amount = 0){
        $wallet = new Wallet();
        $wallet->user_id = $userId;
        $wallet->total_amount = $amount;
        $wallet->save();
    }

    public function updateWallet(Wallet $wallet, $amount, $type){
        if($type == "d")
            $wallet->total_amount += $amount;
        else
            $wallet->total_amount -= $amount;
        $wallet->save();
    }


}
