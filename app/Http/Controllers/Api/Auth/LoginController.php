<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse\Json\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\AuthRepository;
use App\Traits\Authentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use Authentication;
    protected AuthRepository $repository;
    public function __construct(AuthRepository $repository)
    {
        $this->initizationLoginField();
        $this->repository = $repository;

    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::where($this->username(), $request->login)->first();
        $result = $this->repository->checkUserLoginIsValid($user, $request);
        if($result["valid"]){
            $data = $this->repository->loginUser($user, $request);
            return JsonResponse::data($data)->send();
        }
        return JsonResponse::error()->message($result["message"])->changeCode(200)->changeStatusNumber('S400')->send();
    }

    public function logout(Request $request)
    {
        if (Auth::guard("api")->check()) {
            Auth::guard("api")->user()->token()->revoke();
            return JsonResponse::success()->changeCode(200)->message("logout successfully")->send();
        }else
            return JsonResponse::error()->message("the user is not logged in")->changeCode(200)->changeStatusNumber("S404")->send();
    }
}
