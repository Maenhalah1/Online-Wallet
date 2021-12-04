<?php

namespace App\Http\Controllers\Web\Admin\Auth;

use App\Helpers\ApiResponse\Json\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Authentication;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating user for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    use  Authentication, AuthenticatesUsers {
        Authentication::guard insteadof AuthenticatesUsers;
        Authentication::logout insteadof AuthenticatesUsers;
        Authentication::attemptLogin insteadof AuthenticatesUsers;
        Authentication::username insteadof  AuthenticatesUsers;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        $this->initizationLoginField();
    }


    public function showLoginForm()
    {
        switch (true){
            case request()->is("admin*"):
                return $this->showAdminLoginForm();
            break;
            default:
                abort(404);
            break;
        }
    }

    public function showAdminLoginForm()
    {
        return view('admin.auth.login');
    }





}
