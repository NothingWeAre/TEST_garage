<?php
/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 02.08.2017
 * Time: 20:07
 */

namespace Vehicles\VehicleTypeInterface;


use Vehicles\Parts\FuelTank;

interface RequireFuelInterface
{
    function getFuelTank():FuelTank;
}
