<?php
/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 31.07.2017
 * Time: 21:31
 */

namespace Vehicles\VehicleTypeInterface;


interface AerialInterface
{
    function takeOff(): string;

    function fly(): string;

    function land(): string;
}
