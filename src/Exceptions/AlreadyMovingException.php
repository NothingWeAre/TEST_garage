<?php
/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 02.08.2017
 * Time: 16:49
 */

namespace Exceptions;


class AlreadyMovingException extends \Exception
{
    public function __construct()
    {
        parent::__construct('This vehicle already moving');
    }
}