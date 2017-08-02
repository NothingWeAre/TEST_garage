<?php
/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 02.08.2017
 * Time: 20:27
 */

namespace Vehicles;


use Exceptions\AlreadyMovingException;
use Exceptions\NotMovingException;
use Vehicles\VehicleTypeInterface\TerrainInterface;

class BicycleVehicle extends AbstractVehicle implements TerrainInterface
{
    private $inMove = false;

    public function drive(): string
    {
        if($this->inMove){
            throw new AlreadyMovingException();
        }

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
}
