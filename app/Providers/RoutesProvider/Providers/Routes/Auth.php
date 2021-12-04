<?php


namespace App\Providers\RoutesProvider\Providers\Routes;


use App\Providers\RoutesProvider\Providers\IRoutesProvider;
use Illuminate\Support\Facades\Route;

class Auth implements IRoutesProvider
{

    public function mapping($namespace = "App\Http\Controllers\Auth")
    {
        Route::namespace($namespace)->group(function(){
            Route::middleware('web')->group(function(){
                Route::prefix("admin")->name("admin.")->group(function(){
                    Route::group([],base_path('routes/web/admin/auth.php'));
                });
            });
        });



    }
}
