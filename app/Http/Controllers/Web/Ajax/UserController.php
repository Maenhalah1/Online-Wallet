<?php

namespace App\Http\Controllers\Web\Ajax;

use App\Helpers\ApiResponse\Json\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $repository;
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function changeActivation(Request $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->repository->changeActivation($request);
        if($result)
            return JsonResponse::success()->send();
        return JsonResponse::error()->send();
    }
}
