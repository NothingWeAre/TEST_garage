<?php
/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 31.07.2017
 * Time: 21:31
 */

namespace Vehicles\VehicleTypeInterface;


interface TerrainInterface
{
    function drive(): string;

    function stop(): string;
}
