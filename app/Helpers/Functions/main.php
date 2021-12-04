<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

function gateCRUDPermissions($mainName){
    return Gate::check("view-" . $mainName) || Gate::check("create-" . $mainName)
        || Gate::check("update-" . $mainName) || Gate::check("delete-" . $mainName);
}

function isJson($string){
    $data = json_decode($string, true);
    if (is_null($data) || !is_array($data))
       return false;
    return true;
}

function isArabic($string){
    if(mb_detect_encoding($string[0]) == "UTF-8")
        return true;
    return false;

}

function getArrayOfMonths($start = 1, $to = 'now'): array
{
    if($to == 'now')
        $to = date('n');

    $months = [];
    while ($start <= $to){
        $months[] = date("F", mktime(0,0,0,$start ,10));
        $start++;
    }
    return $months;
}

function hasPermissions($permissions){
    $user = Auth::user();

    if($permissions == "admin-control"){
        if($user->is_super_admin == 1)
            return true;
        return false;
    }

    if($user->is_super_admin == 1)
        return true;

    if(is_array($permissions)){
        foreach ($permissions as $permission){
            if(Gate::allows($permission)){
                return true;
            }
        }
    }else{
        if(Gate::allows($permissions)){
            return true;
        }
    }
    return false;
}




