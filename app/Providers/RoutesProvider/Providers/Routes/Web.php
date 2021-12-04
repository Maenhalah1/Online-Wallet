<?php


namespace App\Providers\RoutesProvider\Providers\Routes;


use App\Providers\RoutesProvider\Providers\IRoutesProvider;
use Illuminate\Support\Facades\Route;

class Web implements IRoutesProvider
{

    public function mapping($namespace = "App\Http\Controllers\Web")
    {
        Route::group(["middleware" => ['web'], "namespace" => $namespace],function (){

            // Admin groups
            Route::name("admin.")->prefix("admin")->namespace("Admin")->group(function (){
                Route::middleware("auth:admin")->group(function(){
                    Route::group([],base_path('routes/web/admin/main.php'));
                });
            });

            //Ajax groups
            Route::prefix("ajax")->namespace("Ajax")->name("ajax.")->group(function (){
                Route::group([],base_path('routes/web/ajax/admin.php'));
            });
        });


    }
}
