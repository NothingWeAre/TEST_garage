<?php
/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 01.08.2017
 * Time: 21:17
 */

namespace Exceptions;


class NotInFlightException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Need to take off before flight');
    }
}
