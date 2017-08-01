<?php

namespace Vehicles;

use Exceptions\NoFuelException;
use Vehicles\VehicleTypeInterface\AquaticInterface;

class BoatVehicle extends AbstractVehicle implements AquaticInterface
{
    const FUEL_TYPE = 'diesel';

    private $inMove = false;

    protected function checkFuel(string $fuel): bool
    {
        return $fuel === self::FUEL_TYPE;
    }

    public function getAcceptedFuelType(): string
    {
        return self::FUEL_TYPE;
    }

    function swim(): string
    {
        if(!$this->hasFuel()){
            throw new NoFuelException();
        }

        $this->inMove = true;
        $this->useFuel();

        return 'Swim action successful';
    }

    function stop(): string
    {
        $this->inMove = false;

        return 'Stop action successful';
    }
}
