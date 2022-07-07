<?php

class Notification
{
    protected $destination;
    protected $message;

    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }
}
