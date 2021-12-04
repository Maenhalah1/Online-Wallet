<?php

use Illuminate\Support\Facades\Route;

Route::post("login", "LoginController@login");
Route::post("logout", "LoginController@logout");
Route::post("register", "RegisterController@register");

