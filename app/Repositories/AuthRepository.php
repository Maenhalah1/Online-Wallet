<?php

namespace App\Repositories;

use App\Helpers\ApiResponse\Json\JsonResponse;
use App\Models\Client;
use App\Models\Technician;
use App\Models\User;
use Carbon\Carbon;
use Firebase\Auth\Token\Exception\InvalidToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Kreait\Laravel\Firebase\Facades\Firebase;

class AuthRepository
{
    public function createToken(User $user): string
    {
        $token = $user->createToken(env("TOKEN_KEY"));
        $tokenObj = $token->token;
        $tokenObj->expires_at = Carbon::now()->addWeeks(4);
        $tokenObj->save();
        return $token->accessToken;
    }

    /**
     * @throws \Exception
     */
    public function loginClient(Request $request): array
    {
        $auth = Firebase::auth();
        $firebaseToken = $request->firebase_token;

        try { // Try to verify the Firebase credential token with Google
            $verifiedIdToken = $auth->verifyIdToken($firebaseToken);
            $uid = $verifiedIdToken->claims()->get('sub');
            $client = Client::where('firebase_uid', $uid)->first();
            if($client){
                $user = $client->user;
                $data["token"] = $this->createToken($user);
                $data["user"] = [
                    "full_name" => $user->full_name,
                    "user_type" => $user->type,
                    "email" => $user->email,
                    "phone_number" => $user->phone_number,
                    "photo_profile" => $user->getFirstMediaFile("profile_photo") ? $user->getFirstMediaFile("profile_photo")->url : null,
                ];
                return $data;
            }else{
                throw new \Exception("user not found", 400);
            }

        } catch (\InvalidArgumentException $e) {
            throw new \Exception($e->getMessage(), 500);
        } catch (InvalidToken $e) { // If the token is invalid (expired ...)
            throw new \Exception('token not valid', 401);
        }
    }

    /**
     * @throws \Exception
     */
    public function loginTechnician(Request $request): array
    {
        $field = filter_var($request->login_field, FILTER_VALIDATE_EMAIL) ? "email" : "username";

        if($field == "email"){
            $user = User::where(["email" => $request->login_field, "type" => "t"])->first();
            if($user)
                $technician = $user->technician;
            else
                throw new \Exception ("user not found", 500);

        }else{
            $technician = Technician::where("username", $request->login_field)->first();
            if(!$technician)
                throw new \Exception("user not found", 404);
        }
        if(Hash::check($request->password, $technician->password)){
            $user = $technician->user;
            $data["token"] = $this->createToken($user);
            $data["user"] = [
                "full_name" => $user->full_name,
                "user_type" => $user->type,
                "email" => $user->email,
                "photo_profile" => $user->getFirstMediaFile("profile_photo") ? $user->getFirstMediaFile("profile_photo")->url : null,
            ];
            return $data;
        }
        throw new \Exception("password incorrect", 400);
    }
}
