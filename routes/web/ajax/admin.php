<?php

use Illuminate\Support\Facades\Route;

Route::prefix("/transaction")->name("transaction.")->group(function(){
    Route::post("/change-status", "TransactionController@changeStatus")->name("change_status");
});

Route::prefix("/user")->name("user.")->group(function(){
    Route::post("/change-activation", "UserController@changeActivation")->name("change_activation");
});
