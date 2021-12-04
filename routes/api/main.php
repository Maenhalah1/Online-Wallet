<?php

use Illuminate\Support\Facades\Route;

Route::prefix("transaction")->group(function(){
    Route::get("/", "TransactionController@index");
    Route::post("/", "TransactionController@store");
});

Route::prefix("home")->group(function(){
    Route::get("/", "HomeController@index");
});

Route::prefix("currency")->group(function(){
    Route::get("/", "CurrencyController@index");
    Route::get("/{id}", "CurrencyController@show");
});
