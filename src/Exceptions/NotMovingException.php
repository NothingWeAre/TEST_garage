<?php

namespace Exceptions;

class NotMovingException extends \Exception
{
    public function __construct()
    {
        parent::__construct('This vehicle not moving');
    }
}
