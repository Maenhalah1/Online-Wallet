<?php


namespace App\Helpers\ApiResponse\Json\Senders;


class SendSuccess extends Sender
{
    protected $flash;

    public function __construct()
    {
        $this->code = 201;
        $this->statusNumber = 'S201';
    }

}
