<?php

namespace App\Http\Controllers\Web\Website\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin(){
        return view("user.auth.login");
    }
}
