<?php

namespace App\SelectBuilder\Builders;

use App\SelectBuilder\SelectBuilder;

class Transaction extends SelectBuilder
{

    public function __construct()
    {
        $this->query = \App\Models\Transaction::query();
    }

    public function waiting(): Transaction
    {
        $this->query->where("status", -1);
        return $this;
    }

    public function status($status): Transaction
    {
        $this->query->where("status", $status);
        return $this;
    }


    public function type($type): Transaction
    {
        $this->query->where("type", $type);
        return $this;
    }

    public function forUser($userId){
        $this->query->where("user_id", $userId);
        return $this;
    }
}
