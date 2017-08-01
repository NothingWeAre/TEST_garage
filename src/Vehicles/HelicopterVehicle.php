<?php

namespace Vehicles;

use Exceptions\AlreadyInFlightException;
use Exceptions\NoFuelException;
use Exceptions\NotInFlightException;
use Vehicles\VehicleTypeInterface\AerialInterface;

class HelicopterVehicle extends AbstractVehicle implements AerialInterface
{
    const FUEL_TYPE = 'AvGas';

    private $inFlight = false;

    protected function checkFuel(string $fuel): bool
    {
        return $fuel === self::FUEL_TYPE;
    }

    public function getAcceptedFuelType(): string
    {
        return self::FUEL_TYPE;
    }

    function fly(): string
    {
        if(!$this->hasFuel()){
            throw new NoFuelException();
        }

        if(!$this->inFlight){
            throw new NotInFlightException();
        }

        $this->useFuel();

        return 'Fly action successful';
    }

    function takeOff(): string
    {
        if(!$this->hasFuel()){
            throw new NoFuelException();
        }

        if($this->inFlight){
            throw new AlreadyInFlightException();
        }

        return 'Take-off action successful';
    }

    function land(): string
    {
        if(!$this->inFlight){
            throw new NotInFlightException();
        }
        return 'Land action successful';
    }

    public function isInFlight(): bool
    {
        return $this->inFlight;
    }

}
