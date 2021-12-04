<?php

use Illuminate\Support\Facades\Route;

Route::get('login', "LoginController@showLoginForm")->name("show-login");
Route::post('login', "LoginController@login")->name("login");
Route::post('logout', "LoginController@logout")->name("logout");
