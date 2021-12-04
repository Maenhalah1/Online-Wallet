<?php

namespace App\Http\Controllers\Web\Admin;

use App\Helpers\Dialog\Web\Dialog;
use App\Helpers\Dialog\Web\Types\DangerMessage;
use App\Helpers\Dialog\Web\Types\SuccessMessage;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\PaymentMethod;
use App\Repositories\PaymentMethodsRepository;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{

    protected PaymentMethodsRepository $repository;
    public function __construct(PaymentMethodsRepository $repository)
    {
        $this->repository = $repository;
    }



    public function index()
    {
        $data["paymentMethods"] = PaymentMethod::all();

        return view("admin.payment-method.index", $data);

    }


    public function create(Request $request)
    {
        $data["currencies"] = Currency::all();
        return view("admin.payment-method.create", $data);
    }


    public function store(Request $request)
    {
        $result = $this->repository->validation($request, $this->repository->rules());
        if($result["fails"])
            return redirect()->route("admin.payment_method.create")->withErrors($result["messages"])->withInput($result["inputs"]);
        $this->repository->createPaymentMethod($request);

        $message = (new SuccessMessage())->title("Created Successfully")
            ->body("The Payment Method Has Been Created Successfully");
        Dialog::flashing($message);
        return redirect()->route("admin.payment_method.index");
    }



    public function edit(Request $request, $id)
    {
        $data = $this->repository->editPage($request, $id);
        return view("admin.payment-method.edit", $data);
    }


    public function update(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $result = $this->repository->validation($request, $this->repository->updateRules($request));
        if($result["fails"])
            return redirect()->route("admin.payment_method.edit", $id)->withErrors($result["messages"])->withInput($result["inputs"]);
        $this->repository->savePaymentMethod($paymentMethod, $request);

        $message = (new SuccessMessage())->title("Updated Successfully")
            ->body("The Payment Method Has Been Updated Successfully");
        Dialog::flashing($message);
        return redirect()->route("admin.payment_method.index");
    }


    public function destroy($id)
    {
        $this->repository->deletePaymentMethod(PaymentMethod::findOrFail($id));
        $message = (new DangerMessage())->title("Deleted Successfully")
            ->body("The Payment Method Has Been Deleted Successfully");
        Dialog::flashing($message);
        return redirect()->route("admin.payment_method.index");
    }
}
