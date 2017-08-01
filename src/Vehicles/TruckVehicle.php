<?php
/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 31.07.2017
 * Time: 21:20
 */

namespace Vehicles;

class TruckVehicle extends CarVehicle
{
    const FUEL_TYPE = 'diesel';

    public function unload(): string
    {
        return 'Cargo unload action successful';
    }


}
