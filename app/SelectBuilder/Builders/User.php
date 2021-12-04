<?php

namespace App\SelectBuilder\Builders;

use App\SelectBuilder\SelectBuilder;

class User extends SelectBuilder
{

    public function __construct()
    {
        $this->query = \App\Models\User::query();
    }

    public function byType($type): User
    {
        $this->query->where("type", $type);
        return $this;
    }
}
