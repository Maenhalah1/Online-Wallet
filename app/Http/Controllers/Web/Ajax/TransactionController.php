<?php

namespace App\Http\Controllers\Web\Ajax;

use App\Helpers\ApiResponse\Json\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $repository;
    public function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function changeStatus(Request $request){
        $result = $this->repository->changeStatus($request);
        if($result)
            return JsonResponse::success()->send();
        else
            return JsonResponse::error()->changeCode(400)->send();
    }
}
