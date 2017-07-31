<?php
/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 31.07.2017
 * Time: 20:45
 */

namespace Vehicles;

use Vehicles\VehicleTypeInterface\TerrainInterface;

class CarVehicle extends AbstractVehicle implements TerrainInterface
{
    const FUEL_TYPE = 'gasoline';

    protected function checkFuel(string $fuel)
    {
        return $fuel === self::FUEL_TYPE;
    }

    public function getAcceptedFuelType()
    {
        return self::FUEL_TYPE;
    }

    public function drive()
    {
        return 'Drive movements successful';
    }
}
