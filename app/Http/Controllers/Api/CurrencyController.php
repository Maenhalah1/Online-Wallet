<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse\Json\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        return JsonResponse::data(CurrencyResource::collection(Currency::all()))->send();

    }

    public function show(Request $request)
    {
        return JsonResponse::data(CurrencyResource::make(Currency::find($request->id)))->send();
    }
}
