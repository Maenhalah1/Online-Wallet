<?php

namespace App\Http\Controllers\Web\Admin;

use App\Helpers\Dialog\Web\Dialog;
use App\Helpers\Dialog\Web\Types\DangerMessage;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $repository;
    public function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $data['transactions'] = Transaction::all();
        return view("admin.transaction.index", $data);
    }

    public function filter(Request $request)
    {
        $data['transactions'] = $this->repository->filter($request);
        return view("admin.transaction.index", $data);
    }



    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        Transaction::findOrFail($id)->delete();
        $message = (new DangerMessage())->title("Deleted Successfully")
            ->body("The Transaction Has Been Deleted Successfully");
        Dialog::flashing($message);
        return redirect()->route("admin.transaction.index");
    }
}
