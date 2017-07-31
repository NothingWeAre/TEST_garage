<?php

namespace Vehicles;

use Exceptions\IncorrectFuelTypeException;

abstract class AbstractVehicle
{
    private $hasFuel = false;
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function refuel(string $fuel)
    {
        if(!$this->checkFuel($fuel)){
            throw new IncorrectFuelTypeException($this->getAcceptedFuelType(), $fuel);
        }

        $this->hasFuel = true;

        return 'refueled';
    }

    protected function hasFuel()
    {
        return $this->hasFuel;
    }

    public function getName()
    {
        return $this->name;
    }

    abstract protected function checkFuel(string $fuel);

    abstract public function getAcceptedFuelType();
}
