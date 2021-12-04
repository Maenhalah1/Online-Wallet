<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse\Json\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected AuthRepository $repository;
    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->repository->registerValidation($request);
        if($result["fails"]){
            return JsonResponse::validationErrors($result["messages"])->initAjaxRequest()->changeCode(200)->changeStatusNumber("S400")->send();
        }
        $data = $this->repository->register($request);
        return JsonResponse::data($data)->send();
    }
}
