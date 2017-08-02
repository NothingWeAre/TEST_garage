<?php

namespace Vehicles;

use Exceptions\AlreadyMovingException;
use Exceptions\NotMovingException;
use Vehicles\FunctionTraits\FuelTankTrait;
use Vehicles\Parts\FuelTank;
use Vehicles\VehicleTypeInterface\AquaticInterface;
use Vehicles\VehicleTypeInterface\RequireFuelInterface;

class BoatVehicle extends AbstractVehicle implements AquaticInterface, RequireFuelInterface
{
    use FuelTankTrait;

    const FUEL_TYPE = 'diesel';

    private $inMove = false;

    public function __construct($name)
    {
        $this->setFuelTank(new FuelTank(self::FUEL_TYPE));
        parent::__construct($name);
    }

    function swim(): string
    {
        if($this->inMove){
            throw new AlreadyMovingException();
        }

        $this->getFuelTank()->useFuel();
        $this->inMove = true;

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
