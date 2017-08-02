<?php

namespace Exceptions;

class AlreadyInFlightException extends \Exception
{
    public function __construct()
    {
        parent::__construct('This vehicle already in flight');
    }
}
