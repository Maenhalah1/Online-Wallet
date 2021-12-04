<?php


namespace App\Providers\RoutesProvider\Providers\Routes;


use App\Providers\RoutesProvider\Providers\IRoutesProvider;
use Illuminate\Support\Facades\Route;

class Api implements IRoutesProvider
{


    public function mapping($namespace = "App\Http\Controllers\Api")
    {
//        Route::group(["prefix" => "api/{lang}/", "middleware" => ["api","lang"] , "namespace" => $namespace, "name" => "api."],function() use ($namespace){
//            Route::middleware("auth:api")->group(function(){
//                Route::group([],base_path('routes/api/main.php'));
//                Route::middleware("is.captain")->prefix("captain")->namespace("Captain")->group(function(){
//                    Route::group([],base_path('routes/api/captain.php'));
//                });
//            });
//
//            Route::namespace("Auth")->group(base_path('routes/api/auth.php'));
//        });



    }
}
