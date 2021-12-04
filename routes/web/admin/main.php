<?php

use Illuminate\Support\Facades\Route;

Route::get("/", "DashboardController@index")->name("dashboard.index");

Route::resource("currency", "CurrencyController", ["except" => ["show"]]);

Route::resource("payment-method", "PaymentMethodController",
                        ["except" => ["show"],
                        "names" => [
                            "index" => "payment_method.index",
                            "create" => "payment_method.create",
                            "store" => "payment_method.store",
                            "edit" => "payment_method.edit",
                            "update" => "payment_method.update",
                            "destroy" => "payment_method.destroy"]]);

Route::prefix("transaction")->name("transaction.")->group(function(){
    Route::get("/", "TransactionController@index")->name("index");
    Route::get("/filter", "TransactionController@filter")->name("filter");
    Route::delete("/{id}", "TransactionController@destroy")->name("destroy");
});

Route::prefix("user")->name("user.")->group(function(){
    Route::get("/", "UserController@index")->name("index");

});
