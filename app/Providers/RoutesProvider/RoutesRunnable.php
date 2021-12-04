<?php
namespace App\Providers\RoutesProvider;

use App\Providers\RoutesProvider\Providers\Routes\Api;
use App\Providers\RoutesProvider\Providers\Routes\Auth;
use App\Providers\RoutesProvider\Providers\Routes\Web;

class RoutesRunnable
{

    public static function run(){
        RouteMapping::map(new Api());
        RouteMapping::map(new Web());
        RouteMapping::map(new Auth());

    }

}
