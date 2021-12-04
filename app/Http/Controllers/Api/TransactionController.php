<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse\Json\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMethodResource;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Repositories\PaymentMethodsRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    protected TransactionRepository $repository;
    public function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        $paymentMethodRepository = new PaymentMethodsRepository();
        $data["transactions"] = TransactionResource::collection($this->repository->getUserTransaction(Auth::guard("api")->user()->id));
        $data["paymentMethods"] = PaymentMethodResource::collection($paymentMethodRepository->getAll());
        return JsonResponse::data($data)->send();
    }

    public function store(Request $request){
        $result = $this->repository->validation($request);
        if($result["fails"]){
            return JsonResponse::validationErrors($result["messages"])->initAjaxRequest()->changeCode(200)->changeStatusNumber("S400")->send();
        }
        $this->repository->createTransaction($request, $result["currency"]);
        return JsonResponse::success()->send();
    }
}
