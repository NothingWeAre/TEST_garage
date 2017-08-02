<?php

namespace Exceptions;

class NotInFlightException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Need to take off before flight');
    }
}
