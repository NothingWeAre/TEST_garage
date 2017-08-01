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
     * @return Garage
     */
    public function addVehicle(AbstractVehicle $vehicle): Garage
    {
        $this->vehicles[] = $vehicle;
        return $this;
    }

    /**
     * @return AbstractVehicle[]
     */
    public function getVehicles(): array
    {
        return $this->vehicles;
    }
}
