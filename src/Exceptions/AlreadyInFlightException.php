<?php
/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 01.08.2017
 * Time: 21:45
 */

namespace Exceptions;


class AlreadyInFlightException extends \Exception
{
    public function __construct()
    {
        parent::__construct('This vehicle already in flight');
    }
}
