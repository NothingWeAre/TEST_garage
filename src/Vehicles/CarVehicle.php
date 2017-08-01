<?php

namespace Vehicles;

use Exceptions\NoFuelException;
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
        if(!$this->hasFuel()){
            throw new NoFuelException();
        }

        $this->inMove = true;

        return 'Drive action successful';
    }

    function stop(): string
    {
        $this->inMove = false;

        return 'Stop action successful';
    }
}
