<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;

class UserRepository
{

    public function changeActivation(Request $request): bool
    {
        $user = User::find($request->userId);
        if(!$user)
            return false;
        $user->activation = (bool)$request->activation;
        return $user->save();
    }
}
