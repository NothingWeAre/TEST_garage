<?php

namespace Exceptions;

class NoFuelException extends \Exception
{
    public function __construct()
    {
        parent::__construct('This vehicle has no fuel');
    }
}
