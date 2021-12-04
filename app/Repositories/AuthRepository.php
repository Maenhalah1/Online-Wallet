<?php

namespace App\Repositories;

use App\Helpers\ApiResponse\Json\JsonResponse;
use App\Models\Client;
use App\Models\Technician;
use App\Models\User;
use App\Rules\PasswordPattern;
use Carbon\Carbon;
use Firebase\Auth\Token\Exception\InvalidToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Kreait\Laravel\Firebase\Facades\Firebase;

class AuthRepository
{
    public function createToken(User $user): string
    {
        $token = $user->createToken(env("TOKEN_KEY") ?? "TOKEN_SECRET");
        $tokenObj = $token->token;
        $tokenObj->expires_at = Carbon::now()->addWeeks(4);
        $tokenObj->save();
        return $token->accessToken;
    }


    public function checkUserLoginIsValid(?User $user, Request $request): array
    {
        $result["valid"] = true;
        if($user){
            if(!$user->matchingPassword($request->password)){
                $result["valid"] = false;
                $result["message"] = "The Login Data Are Not Matching ...";
            }else if(!$user->activation){
                $result["valid"] = false;
                $result["message"] = "Your Account Has Been Blocked By Admin";
            }
        }else{
            $result["valid"] = false;
            $result["message"] = "The Login Data Are Not Matching ...";
        }
        return $result;
    }

    public function loginUser(User $user): array
    {
        $data["token"] = $this->createToken($user);
        $data["user"] = [
            "name" => $user->name,
            "username" => $user->username,
            "email" => $user->email,
            "photo_profile" => $user->getFirstMedia("profile_photo") ? $user->getFirstMedia("profile_photo")->url : null,
        ];
        return $data;
    }

    public function registerRules(): array
    {
        return [
            "name"              => ["required", "max:255"],
            "username"          => ["required", "unique:users", "max:255"],
            "email"             => ["required",  "email", "unique:users"],
            "password"          => ["required", "max:255", new PasswordPattern()],
            "confirm_password"  => ["required", "max:255", "same:password"],
        ];
    }

    public function registerValidation(Request $request): array
    {
        $result["fails"] = false;
        $valid = Validator::make($request->all(), $this->registerRules());
        if($valid->fails()){
            $result["fails"] = true;
            $result["messages"] = $valid->errors()->messages();
        }
        return $result;
    }


    public function register(Request $request): array
    {
        $walletRepo = new WalletRepository();
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        $walletRepo->createWallet($user->id);
        return $this->loginUser($user);
    }

}
