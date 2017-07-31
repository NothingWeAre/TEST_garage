<?php

namespace Vehicles;

use Vehicles\VehicleTypeInterface\AerialInterface;

class HelicopterVehicle extends AbstractVehicle implements AerialInterface
{
    const FUEL_TYPE = 'AvGas';

    protected function checkFuel(string $fuel)
    {
        return $fuel === self::FUEL_TYPE;
    }

    public function getAcceptedFuelType()
    {
        return self::FUEL_TYPE;
    }

    function fly()
    {
        return 'Fly movements successful';
    }
}
