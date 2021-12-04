<?php

use Illuminate\Support\Facades\Route;

Route::get('login', "Auth\LoginController@showLogin");
Route::get('/', "HomePageController@index");

Route::prefix('transaction')->group(function (){
    Route::get('/', "TransactionController@index");
});


