<?php

namespace Vehicles;

use Exceptions\AlreadyInFlightException;
use Exceptions\NoFuelException;
use Exceptions\NotInFlightException;
use Vehicles\FunctionTraits\FuelTankTrait;
use Vehicles\Parts\FuelTank;
use Vehicles\VehicleTypeInterface\AerialInterface;
use Vehicles\VehicleTypeInterface\RequireFuelInterface;

class HelicopterVehicle extends AbstractVehicle implements AerialInterface, RequireFuelInterface
{
    use FuelTankTrait;

    const FUEL_TYPE = 'AvGas';

    private $inFlight = false;

    public function __construct($name)
    {
        $this->setFuelTank(new FuelTank(self::FUEL_TYPE));
        parent::__construct($name);
    }

    function fly(): string
    {
        if(!$this->inFlight){
            throw new NotInFlightException();
        }

        $this->getFuelTank()->useFuel();

        return 'Fly action successful';
    }

    function takeOff(): string
    {
        if(!$this->getFuelTank()->hasFuel()){
            throw new NoFuelException();
        }

        if($this->inFlight){
            throw new AlreadyInFlightException();
        }

        $this->inFlight = true;

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
