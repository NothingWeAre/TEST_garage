<?php
/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 01.08.2017
 * Time: 20:58
 */

namespace Exceptions;


class NoFuelException extends \Exception
{
    public function __construct()
    {
        parent::__construct('This vehicle has no fuel');
    }
}
