<?php

namespace App\Helpers\Media\Src;

use App\Helpers\Media\Src\GroupsTypes\MediaType;
use App\Helpers\Media\Src\GroupsTypes\MediaTypeFactory;

class MediaGroups
{
    /**
     * @param MediaType[] $groups
     */
    public array $groups = [];

    public  function setGroup($type, $name, $path = DS): MediaGroups
    {
        $group = MediaTypeFactory::createImageGroup($type);
        $group->setName($name);
        $group->setSavingPath($path);
        array_push($this->groups, $group);
        return $this;
    }

    public  function getAllGroups(): array
    {
        return $this->groups;
    }
}
