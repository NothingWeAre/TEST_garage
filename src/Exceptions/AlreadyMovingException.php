<?php

namespace Exceptions;

class AlreadyMovingException extends \Exception
{
    public function __construct()
    {
        parent::__construct('This vehicle already moving');
    }
}
