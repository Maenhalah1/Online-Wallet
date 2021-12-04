<?php

namespace App\Http\Controllers\Web\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){
        return view("user.home");
    }
}
