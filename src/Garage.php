<?php

use Vehicles\AbstractVehicle;

class Garage
{
    /**
     * @var AbstractVehicle[]
     */
    private $vehicles = [];

    /**
     * @param AbstractVehicle $vehicle
     *
     * @return $this
     */
    public function addVehicle(AbstractVehicle $vehicle){
        $this->vehicles[] = $vehicle;
        return $this;
    }

    /**
     * @return AbstractVehicle[]
     */
    public function getVehicles(){
        return $this->vehicles;
    }
}
