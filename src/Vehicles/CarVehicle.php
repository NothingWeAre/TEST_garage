<?php

namespace Vehicles;

use Exceptions\AlreadyMovingException;
use Exceptions\NoFuelException;
use Exceptions\NotMovingException;
use Vehicles\VehicleTypeInterface\TerrainInterface;

class CarVehicle extends AbstractVehicle implements TerrainInterface
{
    const FUEL_TYPE = 'gasoline';

    private $inMove = false;

    protected function checkFuel(string $fuel): bool
    {
        return $fuel === self::FUEL_TYPE;
    }

    public function getAcceptedFuelType(): string
    {
        return self::FUEL_TYPE;
    }

    public function drive(): string
    {
        if($this->inMove){
            throw new AlreadyMovingException();
        }

        if(!$this->hasFuel()){
            throw new NoFuelException();
        }

        $this->inMove = true;
        $this->useFuel();

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

    function musicOn(): string
    {
        return 'You are listening to music';
    }
}
