<?php

namespace App\SelectBuilder;

trait WithSelectBuilder
{

    public static function selectBuilder(){
        $class = "\App\SelectBuilder\Builders\\" . class_basename(__CLASS__);
        return new $class;
    }

}
