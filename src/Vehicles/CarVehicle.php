<?php

namespace Vehicles;

use Exceptions\AlreadyMovingException;
use Exceptions\NotMovingException;
use Vehicles\FunctionTraits\FuelTankTrait;
use Vehicles\FunctionTraits\MusicTrait;
use Vehicles\Parts\FuelTank;
use Vehicles\VehicleTypeInterface\HasEntertainmentInterface;
use Vehicles\VehicleTypeInterface\RequireFuelInterface;
use Vehicles\VehicleTypeInterface\TerrainInterface;

class CarVehicle extends AbstractVehicle implements TerrainInterface, RequireFuelInterface, HasEntertainmentInterface
{
    use MusicTrait;
    use FuelTankTrait;

    const FUEL_TYPE = 'gasoline';

    private $inMove = false;
    /**
     * @var FuelTank
     */
    private $fuelTank;

    public function __construct($name)
    {
        $this->setFuelTank(new FuelTank(self::FUEL_TYPE));
        parent::__construct($name);
    }

    public function drive(): string
    {
        if($this->inMove){
            throw new AlreadyMovingException();
        }

        $this->getFuelTank()->useFuel();
        $this->inMove = true;

        return 'Drive action successful';
    }

    function stop(): string
    {
        if(!$this->inMove){
            throw new NotMovingException();
        }

        $this->inMove = false;

        return 'Stop action successful';
    }

    function getFuelTank(): FuelTank
    {
        return $this->fuelTank;
    }
}
