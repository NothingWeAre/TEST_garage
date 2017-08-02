<?php

namespace Vehicles;

use Exceptions\AlreadyMovingException;
use Exceptions\NoFuelException;
use Exceptions\NotMovingException;
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
        if($this->inMove){
            throw new AlreadyMovingException();
        }

        if(!$this->hasFuel()){
            throw new NoFuelException();
        }

        $this->inMove = true;
        $this->useFuel();

        return 'Swim action successful';
    }

    function stop(): string
    {
        if(!$this->inMove){
            throw new NotMovingException();
        }

        $this->inMove = false;

        return 'Stop action successful';
    }
}
