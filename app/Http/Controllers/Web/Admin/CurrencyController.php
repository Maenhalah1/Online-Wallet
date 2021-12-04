<?php

namespace App\Http\Controllers\Web\Admin;

use App\Helpers\Dialog\Web\Dialog;
use App\Helpers\Dialog\Web\Types\DangerMessage;
use App\Helpers\Dialog\Web\Types\SuccessMessage;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Repositories\CurrencyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    protected CurrencyRepository $repository;
    public function __construct(CurrencyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $data["currencies"] = Currency::all();
        return view("admin.currency.index", $data);
    }


    public function create()
    {
        return view("admin.currency.create");
    }


    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $valid = Validator::make($request->all(), $this->repository->rules(), [], $this->repository->columns());
        if($valid->fails())
            return redirect()->route("admin.currency.create")->withErrors($valid->errors()->messages())->withInput($request->all());

        $this->repository->createCurrency($request);

        $message = (new SuccessMessage())->title("Created Successfully")
            ->body("The Currency Has Been Created Successfully");
        Dialog::flashing($message);
        return redirect()->route("admin.currency.index");
    }


    public function edit($id)
    {
        $data["currency"] = Currency::findOrFail($id);
        return view("admin.currency.edit", $data);
    }


    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $currency = Currency::findOrFail($id);
        $valid = Validator::make($request->all(), $this->repository->updateRules($request, $currency), [], $this->repository->columns());
        if($valid->fails())
            return redirect()->route("admin.currency.edit", $id)->withErrors($valid->errors()->messages())->withInput($request->all());

        $this->repository->saveCurrency($currency, $request);

        $message = (new SuccessMessage())->title("Updated Successfully")
            ->body("The Currency Has Been Updated Successfully");
        Dialog::flashing($message);
        return redirect()->route("admin.currency.index");
    }


    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        Currency::findOrFail($id)->delete();

        $message = (new DangerMessage())->title("Deleted Successfully")
            ->body("The Currency Has Been Deleted Successfully");
        Dialog::flashing($message);
        return redirect()->route("admin.currency.index");
    }
}
