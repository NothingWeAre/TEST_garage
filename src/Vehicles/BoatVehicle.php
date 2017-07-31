<?php
/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 31.07.2017
 * Time: 20:58
 */

namespace Vehicles;


use Vehicles\VehicleTypeInterface\AquaticInterface;

class BoatVehicle extends AbstractVehicle implements AquaticInterface
{
    const FUEL_TYPE = 'diesel';

    protected function checkFuel(string $fuel)
    {
        return $fuel === self::FUEL_TYPE;
    }

    public function getAcceptedFuelType()
    {
        return self::FUEL_TYPE;
    }

    function swim()
    {
        return 'Swim movements successful';
    }
}
