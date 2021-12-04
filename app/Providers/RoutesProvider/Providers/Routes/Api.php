<?php


namespace App\Providers\RoutesProvider\Providers\Routes;


use App\Providers\RoutesProvider\Providers\IRoutesProvider;
use Illuminate\Support\Facades\Route;

class Api implements IRoutesProvider
{


    public function mapping($namespace = "App\Http\Controllers\Api")
    {
        Route::group(["prefix" => "api/", "middleware" => ["api"] , "namespace" => $namespace, "name" => "api."],function() use ($namespace){
            Route::middleware("auth:api")->group(function(){
                Route::group([],base_path('routes/api/main.php'));
            });
            Route::namespace("Auth")->group(base_path('routes/api/auth.php'));
        });



    }
}
