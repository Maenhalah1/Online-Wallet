<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse\Json\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\WalletResource;
use App\Repositories\WalletRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $data["wallet"] = WalletResource::make(Auth::guard("api")->user()->wallet);
        return JsonResponse::data($data)->send();
    }
}
