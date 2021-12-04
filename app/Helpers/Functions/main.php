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

function getUserTypeName($type){
    switch ($type){
        case "wk": return __("Worker"); break;
        case "cr": return __("Contractor"); break;
        case "cc": return __("Contractor Company"); break;
        case "eo": return __("Engineering Office"); break;
        case "om": return __("Owner Mechanisms"); break;
        case "ml": return __("Material Laboratory"); break;
        case "sp": return __("Supplier"); break;
        case "cl": return __("Client"); break;
    }
}

function getSameWithNewLanguage($lang){
    $path = request()->path();
    for ($char = 0; strlen($path); $char++){
        if($path[$char] !== "/")
            $path[$char] = ' ';
        else
            break;
    }
    $path = trim($path, " /");
    return "/" . $lang . "/" . $path;
}


