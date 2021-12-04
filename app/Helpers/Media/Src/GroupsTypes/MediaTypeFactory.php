<?php

namespace App\Helpers\Media\Src\GroupsTypes;

class MediaTypeFactory
{
    public static function createImageGroup($type) : MediaType{
        try {
            switch ($type){
                case "single":
                    $group = new SingleMedia();
                    break;
                case "multi":
                    $group = new MultiMedia();
                    break;
                default:
                    throw new \Exception("The Group Types of Media is not exists");
                break;
            }
            return $group;
        }catch (\Exception $e){
            die($e->getMessage());
        }

    }

}
